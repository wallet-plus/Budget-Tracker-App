import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { BudgetService } from 'src/app/services/budget.service';

@Component({
  selector: 'app-headerback',
  templateUrl: './headerback.component.html',
  styleUrls: ['./headerback.component.scss']
})
export class HeaderbackComponent implements OnInit {  
  pageName : string;
  constructor() { }

  ngOnInit() {


    
    const currentURL = document.location.href;
    if (currentURL.includes("expense")) {
      this.pageName = 'Expense';
    } else if (currentURL.includes("income")) {
      this.pageName = 'Income';
    } else if (currentURL.includes("savings")) {
      this.pageName = 'Savings';
    } else if (currentURL.includes("profile")) {
      this.pageName = 'Profile';
    } else if (currentURL.includes("termsandconditions")) {
      this.pageName = 'Terms & Conditions';
    } else if (currentURL.includes("card")) {
      this.pageName = 'Card';
    } else if (currentURL.includes("user")) {
      this.pageName = 'User';
    } else if (currentURL.includes("zakat-calculator")) {
      this.pageName = 'ZAKAT CALCULATOR';
    } else {
      this.pageName = 'Expense';
    }

  }

  backnav() {
    window.history.back();
    return false;
  }

  share(){
    const text = encodeURIComponent('Calculate zakat for free only on WalletPlus visit: ');
    const url = encodeURIComponent('https://secure.walletplus.in/zakat-calculator');
    let whatsappUrl = `https://web.whatsapp.com/send?text=${text}${url}`;
    window.open(whatsappUrl, '_blank');
  }

}
