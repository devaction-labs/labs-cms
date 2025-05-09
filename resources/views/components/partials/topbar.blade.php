<div class="bg-neutral py-1.5 text-center text-xs text-neutral-content md:text-sm">
  <span>
    Revamp Your Control: Code
    <span class="font-semibold text-warning">DAISYUI</span>
    for a 20% SaaS discount 🚀
  </span>
</div>

<div
    id="navbar-wrapper"
    class="sticky top-0 z-10 border-b bg-base-100 lg:bg-opacity-95 lg:backdrop-blur-sm"
    x-data="{ atTop: false }"
    :class="{ 'border-base-content/10': atTop, 'border-transparent': !atTop}"
    @scroll.window="atTop = (window.pageYOffset < 30) ? false: true">
    <div class="container">
        <nav class="navbar px-0">
            <div class="navbar-start gap-2">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer" id="my-drawer-trigger" aria-label="open sidebar"
                           class="btn btn-square btn-ghost">
                        <i class="icon-menu inline-block text-xl"></i>
                    </label>
                </div>

                <!-- Navbar Brand logo -->
                <a href="#" class="text-xl font-bold tracking-tighter">SaaS Landing</a>
            </div>

            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal menu-sm gap-2 px-1">
                    <li class="font-medium"><a href="#home">Home</a></li>
                    <li class="font-medium"><a href="#features">Features</a></li>
                    <li class="font-medium"><a href="#integrations">Integrations</a></li>
                    <li class="font-medium"><a href="#pricing">Pricing</a></li>
                    <li class="font-medium"><a href="#faq">FAQ</a></li>
                </ul>
            </div>

            <div class="navbar-end gap-3">
                <a class="btn btn-ghost btn-sm" onclick="register_modal.showModal()">Register</a>
                <livewire:auth.login />
            </div>
        </nav>

        <!-- sm screen menu (drawer) -->
        <div class="drawer">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-side">
                <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

                <ul class="menu min-h-full w-80 gap-2 bg-base-100 p-4 text-base-content">
                    <!-- Navbar Brand logo -->
                    <li class="font-medium">
                        <a href="index.html" class="text-xl font-bold">SaaS Landing</a>
                    </li>

                    <li class="font-medium"><a href="#home">Home</a></li>
                    <li class="font-medium"><a href="#features">Features</a></li>
                    <li class="font-medium"><a href="#integrations">Integrations</a></li>
                    <li class="font-medium"><a href="#pricing">Pricing</a></li>
                    <li class="font-medium"><a href="#faq">FAQ</a></li>
                </ul>
            </div>
        </div>
        <dialog id="register_modal" class="modal">
            <div class="modal-box md:max-w-sm max-w-xs">
                <div class="text-center">
                    <h3 class="font-semibold text-xl">Register</h3>
                </div>

                <div>
                    <div class="form-control mt-6">
                        <label class="label" for="register_username">
                            <span class="label-text  font-medium">Username</span>
                        </label>
                        <input
                            autocomplete="name"
                            id="register_username"
                            class="input join-item input-bordered w-full input-sm"
                            placeholder="saadeghi"
                            type="text"
                            required />
                    </div>
                    <div class="form-control mt-2">
                        <label class="label" for="register_email">
                            <span class="label-text  font-medium">Email</span>
                        </label>
                        <input
                            autocomplete="email"
                            id="register_email"
                            class="input join-item input-bordered w-full input-sm"
                            placeholder="name@daisyui.com"
                            type="email"
                            required />
                    </div>
                    <div class="form-control mt-2">
                        <label class="label" for="register_password">
                            <span class="label-text font-medium">Password</span>
                        </label>
                        <input
                            autocomplete="password"
                            id="register_password"
                            class="input join-item input-bordered w-full input-sm"
                            placeholder="It's secret"
                            type="password"
                            required />
                        <div class="label">
                            <span class="label-text-alt text-base-content/70 text-xs">Min 8 letters required</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-3  gap-3">
                        <button class="btn btn-sm btn-primary">
                            Register
                        </button>
                    </div>
                    <div class="flex items-center gap-3 mt-6">
                        <hr class="border-base-content/5 grow" />
                        <span class="text-base-content/70">Continue with</span>
                        <hr class="border-base-content/5 grow" />
                    </div>

                    <div class="flex mt-6 gap-4">
                        <button class="btn block btn-sm grow">
                            Google
                        </button>
                        <button class="btn block btn-sm grow btn-neutral">
                            Github
                        </button>
                    </div>
                </div>

            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>
</div>
