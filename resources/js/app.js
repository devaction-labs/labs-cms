import './bootstrap';
import '@nextapps-be/livewire-sortablejs';

document.addEventListener('livewire:init', () => {
    Livewire.hook('request', ({ fail }) => {
        fail(({ status, content, preventDefault }) => {
            try {
                content = JSON.parse(content);

                if (status === 419 || content.status === 419) {
                    window.location.reload();
                    preventDefault();
                }

                if (content.toast) {
                    toast({ toast: content.toast });
                    preventDefault();
                }
            } catch (e) {
                console.log(e);
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const myDrawerTrigger = document.querySelector('.drawer #my-drawer');
    document.querySelectorAll('.drawer .drawer-side ul li').forEach((el) => {
        el.addEventListener('click', () => {
            if (myDrawerTrigger) {
                myDrawerTrigger.checked = false;
            }
        });
    });
});
