const notyf = new Notyf({
    duration: 5000,
    position: {
        x: 'right',
        y: 'top'
    },
    dismissible: true,
    ripple: true,
    types: [
        {
            type: 'success',
            background: 'green',
            icon: {
                className: 'fas fa-check',
                tagName: 'i',
                color: '#fff'
            }
        },
        {
            type: 'error',
            background: 'red',
            icon: {
                className: 'fas fa-times',
                tagName: 'i',
                color: '#fff'
            }
        }
    ]
});