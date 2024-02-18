import { NgModule, Component } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { StatsComponent } from './stats/stats.component';
import { ApphomelayoutComponent } from './apphomelayout.component';
import { ProfileComponent } from '../appinnerlayout/profile/profile.component';
import { StyleComponent } from '../appinnerlayout/style/style.component';
import { ExpensesComponent } from './expenses/expenses.component';
import { IncomeComponent } from './income/income.component';
import { SavingsComponent } from './savings/savings.component';
import { SharedModule } from '../shared/shared.module';
import { CardsComponent } from './cards/cards.component';
import { UsersComponent } from './users/users.component';
import { TranslateModule } from '@ngx-translate/core';

const routes: Routes = [
  {
    path:'',
    component: ApphomelayoutComponent,

    children:[
      {
        path:'home',
        component: HomeComponent
      },      
      {
        path:'stats',
        component: StatsComponent
      },         
      {
        path:'expenses',
        component : ExpensesComponent
      },
      {
        path:'income',
        component : IncomeComponent
      },
      {
        path:'savings',
        component : SavingsComponent
      },  
      {
        path:'cards',
        component : CardsComponent
      },
      
      {
        path:'users',
        component : UsersComponent
      },
      {
        path:'style',
        component: StyleComponent
      }
    ]
  }
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes),
    SharedModule,
    TranslateModule.forChild()
  ],
  exports: [RouterModule]
})
export class ApphomelayoutRoutingModule { }
