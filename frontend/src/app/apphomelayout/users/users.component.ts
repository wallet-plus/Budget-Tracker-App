import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import { BudgetService } from 'src/app/services/budget.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss']
})
export class UsersComponent implements OnInit {
  conversionPrice: number = 1;
  userInfo :  any;

  userList : any;
  imagePath : string = '';
  userImagePath : string = '';
  
  constructor( 
    private router: Router,
    private authService: AuthService,
    private localStorageService : LocalStorageService) { }

  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem("userInfo");
    if(this.userInfo){
      this.authService.getUsers().subscribe(
        (response : any) => {
          // this.imagePath = response.imagePath;
          this.userImagePath = response.userImagePath;
          this.userList = response.list;
        },(error: any) => { },
      );
    }
  }

  openUser(user: any){
    // const navigationExtras: NavigationExtras = {
    //   queryParams: {
    //     id: expense.id_expense
    //   },
    // };
    // this.router.navigate(['/add', type], navigationExtras);
    this.router.navigate(['/user', user.id]);
  }



}
