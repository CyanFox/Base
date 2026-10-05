import './echo';

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
            fetch('/api/v1/refresh-csrf').then(r => r.json()).then(response => {
                try {
                    if (response.success && response.data?.token) {
                        document.querySelector('meta[name="csrf-token"]').content = response.data.token;
                        Livewire.csrfToken = response.data.token;
                        retry();
                    }
                } catch (e) {
                }
            });
        }
    });
});

async function getTranslation(key, fallback) {
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 1000);

    try {
        const response = await fetch(`/api/v1/lang/${encodeURIComponent(key)}`, {
            signal: controller.signal,
            headers: {
                'Accept': 'application/json'
            }
        });

        clearTimeout(timeoutId);

        if (!response.ok) {
            throw new Error('API request failed');
        }

        const data = await response.json();
        if (data.success && data.data?.value) {
            return data.data.value;
        }
        throw new Error('Invalid API response');
    } catch (error) {
        clearTimeout(timeoutId);
        return fallback || key;
    }
}

window.getTranslation = getTranslation;
