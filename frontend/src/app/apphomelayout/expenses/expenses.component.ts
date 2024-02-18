import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { BudgetService } from 'src/app/services/budget.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';
import * as moment from 'moment';

@Component({
  selector: 'app-expenses',
  templateUrl: './expenses.component.html'
})
export class ExpensesComponent implements OnInit {
  userInfo :  any;
  expenseList : any;
  imagePath : string = '';
  categoryImagePath : string = '';
  queryParam : string;
  category : number;
  categoryList : any;

  public daterange: any = {};
  public options: any = {
    locale: { format: 'DD-MM-YYYY', direction: 'daterange-center shadow' },
    alwaysShowCalendars: false,
  };
  startDate: any;
  endDate: any;
  totalExpense: number = 0;
  constructor( 
    private router: Router,
    private bugetService: BudgetService,
    private localStorageService : LocalStorageService) { }

  ngOnInit(): void {

    const today = moment();

    const startOfMonth = today.clone().startOf('month');
    const endOfMonth = today.clone().endOf('month');

    this.startDate = startOfMonth.format('YYYY-MM-DD');
    this.endDate = endOfMonth.format('YYYY-MM-DD');


    this.options['startDate'] = startOfMonth.format('DD-MM-YYYY');
    this.options['endDate'] = endOfMonth.format('DD-MM-YYYY');


    this.userInfo = this.localStorageService.getItem("userInfo");
    if(this.userInfo){
      this.getRecords();
      this.getCategories();
    }
  }


  public selectedDate(value: any, datepicker?: any) {

    // any object can be passed to the selected event and it will be passed back here
    datepicker.start = value.start;
    datepicker.end = value.end;

    // use passed valuable to update state
    this.daterange.start = value.start;
    this.daterange.end = value.end;
    this.daterange.label = value.label;

    this.startDate = moment(value.start).format('YYYY-MM-DD');
    this.endDate = moment(value.end).format('YYYY-MM-DD');
    // this.searchRecords();
  }

  resetTotalExpense(){
    this.expenseList = [];
    this.totalExpense = 0;
  }

  getRecords(){
    this.resetTotalExpense();
    this.bugetService.getList(2, this.queryParam, this.category, this.startDate, this.endDate).subscribe(
      (response) => {
        this.imagePath = response.imagePath;
        this.categoryImagePath = response.categoryImagePath;
        this.expenseList = response.list;
        if(this.expenseList){
          this.expenseList.forEach((expense: any) => {
            this.totalExpense += parseFloat(expense.amount);
          });
        }
      },(error) => { },
    );
  }


  openTransaction(expense: any, type: string){
    // const navigationExtras: NavigationExtras = {
    //   queryParams: {
    //     id_expense: expense.id_expense
    //   },
    // };
    // navigationExtras
    this.router.navigate(['/add', type, expense.id_expense]);
  }

  getCategories(){
    this.bugetService.categoryList('expense').subscribe(
      (response) => {
        this.categoryList = response;
      },(error) => { },
    );
  }

}
