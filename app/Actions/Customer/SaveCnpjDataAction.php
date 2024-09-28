<?php

namespace App\Actions\Customer;

use App\DTO\Cnpja\CnpjDataDTO;
use App\Models\{Activity,
    Address,
    Company,
    Country,
    Customer,
    Email,
    Member,
    MemberRole,
    Nature,
    Person,
    Phone,
    Registration,
    RegistrationType,
    Size,
    Status};
use Illuminate\Support\Facades\DB;

class SaveCnpjDataAction
{
    public function execute(CnpjDataDTO $dto, array $data): Company
    {
        return DB::transaction(function () use ($dto) {

            $customer = Customer::firstOrCreate(
                ['id' => $dto->customerId],
                [
                    'name'   => $dto->company->name,
                    'tax_id' => $dto->taxId,
                    'email'  => !empty($dto->emails) ? $dto->emails[0]->address : null,
                ]
            );

            $nature = Nature::query()->firstOrCreate(['code' => $dto->company->nature->id], ['text' => $dto->company->nature->text]);
            $size   = Size::query()->firstOrCreate(['code' => $dto->company->size->id], ['acronym' => $dto->company->size->acronym, 'text' => $dto->company->size->text]);

            $company = Company::query()->updateOrCreate(
                ['customer_id' => $customer->id],
                [
                    'name'      => $dto->company->name,
                    'equity'    => $dto->company->equity,
                    'nature_id' => $nature->id,
                    'size_id'   => $size->id,
                ]
            );

            $country = Country::query()->firstOrCreate(
                ['id' => $dto->address->country->id],
                [
                    'name' => $dto->address->country->name,
                    'code' => $dto->address->country->id,
                ]
            );

            Address::query()->updateOrCreate(
                ['customer_id' => $customer->id],
                [
                    'street'     => $dto->address->street,
                    'number'     => $dto->address->number,
                    'details'    => $dto->address->details,
                    'district'   => $dto->address->district,
                    'city'       => $dto->address->city,
                    'state'      => $dto->address->state,
                    'zip'        => $dto->address->zip,
                    'country_id' => $country->id,
                ]
            );

            foreach ($dto->emails as $emailDTO) {

                Email::query()->firstOrCreate(
                    ['email' => $emailDTO->address, 'customer_id' => $customer->id],
                    ['domain' => $emailDTO->domain]
                );
            }

            foreach ($dto->phones as $phoneDTO) {
                Phone::query()->firstOrCreate(
                    ['number' => $phoneDTO->number, 'customer_id' => $customer->id],
                    ['area' => $phoneDTO->area]
                );
            }

            foreach ($dto->sideActivities as $activityDTO) {
                Activity::query()->firstOrCreate(
                    ['code' => $activityDTO->id],
                    [
                        'text'        => $activityDTO->text,
                        'customer_id' => $customer->id,
                    ]
                );
            }

            foreach ($dto->company->members as $memberDTO) {
                $role   = MemberRole::query()->firstOrCreate(['id' => $memberDTO->role->id], ['code' => $memberDTO->role->id, 'text' => $memberDTO->role->text]);
                $person = Person::query()->firstOrCreate(
                    ['id' => $memberDTO->person->id],
                    [
                        'name'        => $memberDTO->person->name,
                        'type'        => $memberDTO->person->type,
                        'tax_id'      => $memberDTO->person->taxId,
                        'age'         => $memberDTO->person->age,
                        'customer_id' => $customer->id,
                    ]
                );

                Member::query()->updateOrCreate(
                    ['company_id' => $company->id, 'person_id' => $person->id],
                    ['since' => $memberDTO->since, 'member_role_id' => $role->id]
                );
            }

            foreach ($dto->registrations as $registrationDTO) {
                $status = Status::query()->firstOrCreate(['code' => $registrationDTO->status->id], ['text' => $registrationDTO->status->text]);
                $type   = RegistrationType::query()->firstOrCreate(['code' => $registrationDTO->type->id], ['text' => $registrationDTO->type->text]);

                Registration::query()->updateOrCreate(
                    ['customer_id' => $customer->id, 'state' => $registrationDTO->state],
                    [
                        'number'               => $registrationDTO->number,
                        'enabled'              => $registrationDTO->enabled,
                        'status_date'          => $registrationDTO->statusDate,
                        'status_id'            => $status->id,
                        'registration_type_id' => $type->id,
                    ]
                );
            }

            return $company;
        });
    }
}
