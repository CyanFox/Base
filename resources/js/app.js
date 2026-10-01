Livewire.on('logger', (data) => {
    for (let i = 0; i < data.length; i++) {
        const {type, message} = data[i]

        switch (type) {
            case 'info':
                console.info(message);
                break;
            case 'warn':
                console.warn(message);
                break;
            case 'error':
                console.error(message);
                break;
            default:
                console.log(message);
        }
    }
});

Livewire.hook('request', ({fail}) => {
    fail(({status, preventDefault, retry}) => {
        if (status === 419) {
            preventDefault();
            fetch('/api/v1/refresh-csrf').then(r => r.json()).then(data => {
                try {
                    document.querySelector('meta[name="csrf-token"]').content = data.token;
                    Livewire.csrfToken = data.token;
                    retry();
                } catch (e) {
                }
            });
        }
    });
});
