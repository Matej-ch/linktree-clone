document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('body').addEventListener('click', e => {
        if (e.target.classList.contains('js-user-link')) {

            const formData = new FormData();
            formData.append('link', e.target.href);

            fetch('/visit/' + e.target.dataset.linkId, {
                method: 'POST',
                body: formData,
            }).then(res => res.json())
                .then(data => {
                })
                .catch(err => console.error(err));
        }
    })

});