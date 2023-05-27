document.querySelectorAll('.remove-contact').forEach(function (el) {
    el.addEventListener('click', function () {
        const id = this.dataset.id
        const name = this.dataset.name
        document.getElementById('contact_id').innerHTML = id
        document.getElementById('contact_name').innerHTML = name
        document.getElementById('modal_remove_contact').classList.remove('hidden')
    })
});
document.getElementById('modal_remove_contact').classList.add('hidden');

document.getElementById('confirm_request').addEventListener('click', async function () {
    const id = document.getElementById('contact_id').innerHTML
    const csrfToken = document.getElementById('csrf_token').value
    fetch(`/contacts/${id}`, {
        method: 'delete',
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(async response => {
        document.getElementById('modal_remove_contact').classList.add('hidden');
        if (response.status == 200) {
            await addNotification('success', 'Contact removed successfully.')
            location.reload();
        } else {
            const data = await response.json();
            const error = data.message;
            addNotification('error', error)
            return Promise.reject(error);
        }
    })
})
document.getElementById('cancel_request').addEventListener('click', function () {
    document.getElementById('modal_remove_contact').classList.add('hidden');
})

async function addNotification(type, message) {
    let color = '';
    switch (type) {
        case 'success':
            color = 'green';
            break;
        case 'error':
            color = 'red';
        default:
            color = 'blue'
            break;
    }
    const card = `<div
    class="flex flex-col space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-3 flex justify-start items-end inset-0 z-50 outline-none focus:outline-none">
    <div class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-16 h-16 rounded-2xl p-3 border border-${color}-100 text-${color}-400 bg-${color}-50" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex flex-col ml-3">
                    <div class="font-medium leading-none">${message}</div>
                </div>
            </div>
        </div>
    </div>
</div>`
    document.getElementById('notification').innerHTML = card;
    clearNotifications();
}


function clearNotifications()
{
    return setTimeout(function (){
        document.getElementById('notification').innerHTML = '';
    }, 3000);
}

clearNotifications();