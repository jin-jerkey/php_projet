document.getElementById('openWindowButton').addEventListener('click', function() {
    document.getElementById('newWindow').classList.remove('hidden');
});

document.getElementById('closeWindowButton').addEventListener('click', function() {
    document.getElementById('newWindow').classList.add('hidden');
});
