import http from "../http";
// import { logout } from "../logout";
import Alpine from 'alpinejs'

export function userDetails() {

  // var imTired = {};

  const account  = http.get('/user/get-profile').then((response) =>{
      // return res.json;
      // imTired = response.data;
      return (response.data);
  } ).catch((error)=>{
      if (error.response && error.response.status === 401) {
        // logout();
      }

  })

  account.then((data)=>{

    Alpine.store('user_info', data);
    Alpine.store('account_numbers', data?.accounts);

    const storedAccountNumber = localStorage.getItem('active_account_number');

     const activeAccountNumber =  JSON.parse(storedAccountNumber);


    if (activeAccountNumber) {
      Alpine.store('active_account_number', activeAccountNumber);
    } else {
      Alpine.store('active_account_number', data?.accounts[0]);
    }

  })






  return {
    setActiveAccount (acct){
      Alpine.store('active_account_number', acct);
      // console.log(JSON.stringify(acct));
     localStorage.setItem('active_account_number', JSON.stringify(acct));
    }

  };






}
