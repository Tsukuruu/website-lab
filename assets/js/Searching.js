const users = document.querySelectorAll('.users__user');
const userTable = document.querySelector('.users');
const searchBar = document.querySelector('.search-bar');

searchBar.addEventListener('input', function(){
    
    users.forEach(u => userTable.contains(u) &&  u.remove());
    for(let u of users){
        if(u.dataset.search.match(new RegExp(`^${this.value}`, 'i'))){
            userTable.append(u);
        }
    }
})