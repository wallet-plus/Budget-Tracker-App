import { Component, ElementRef, HostListener, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { ZakatService } from 'src/app/services/zakat.service';

@Component({
  selector: 'app-zakat-calculator',
  templateUrl: './zakat-calculator.component.html',
  styleUrls: ['./zakat-calculator.component.scss']
})
export class ZakatCalulatorComponent implements OnInit {
  zakatForm: FormGroup;
  categoryList: any;
  cityList : any;
  stateList : any;
  countryList : any;
  pricesData: any;
  totalZakatAmount : number = 0;
  constructor(private zakatService: ZakatService, private fb: FormBuilder) { }

  preventText($event: any) {
    const value = $event.target.value.replace(/[a-zA-Z%@*^$!`)(_+=#&\s]/g, '');
    $event.target.value = value;
  }

  ngOnInit(): void {
    this.zakatForm = this.fb.group({});
    // this.getCountries();
    this.getZakatCategories();
  }

  getZakatCategories() {
    this.zakatService.getCategories().subscribe((resp: any) => {
      this.categoryList = resp.list;
      this.categoryList.forEach((category: any) => {
        let categories: any = [];
        this.categoryList.forEach((cat: any) => {
          if (category.id_category == cat.parent) {
            categories.push(cat);
          }
        });
        category['child'] = categories;

        this.zakatForm.addControl(category.id_category.toString(), new FormControl('no'));
        this.zakatForm.addControl(category.id_category.toString() + '_quantity', new FormControl(0));
      });


      this.zakatService.getLocationPrices(1).subscribe((resp: any) => {
        this.pricesData = resp.list;
        this.categoryList.forEach((category: any) => {
          category['price'] = 1;
          this.pricesData.forEach((pD: any) => {
            if (pD.id_category == category.id_category) {
              category['price'] = (pD.price) ? pD.price : 1;
            }
          });
        });
      });
    });
  }

  // getCountries(){
  //   this.zakatService.getCountries().subscribe((resp: any)=>{
  //     this.countryList = resp.list;
  //   });
  // }
 
  // getStates(event : any){
  //   this.zakatService.getStates(event.value).subscribe((resp: any)=>{
  //     this.stateList = resp.list;
  //   });
  // }


  // getCities(event : any){
  //   this.zakatService.getCities(event.value).subscribe((resp: any)=>{
  //     this.cityList = resp.list;
  //   });
  // }



  // getLocationPrices(event : any){
  //   this.zakatService.getLocationPrices(event.value).subscribe((resp: any)=>{
  //     this.pricesData = resp.list;
  //       this.categoryList.forEach((category: any) => {
  //         category['price'] = 1;
  //         this.pricesData.forEach((pD: any) => {
  //           if(pD.id_category == category.id_category){
  //             category['price'] = (pD.price)?pD.price: 1;
  //           }
  //         });
  //       });
  //   });
  // }

  getChildCategories(category: any) {
    let categories = [];

  }

  checkZakatAmount() {

  }

  checkCategoryZakatAmount(category: any) {


    // this.totalZakatAmount = 0;
    let quantity = parseFloat(this.zakatForm.controls[category.id_category + '_quantity'].value);
    category['categoryAmount'] = ((this.zakatForm.controls[category.id_category + '_quantity'].value) * parseFloat(category.price)).toFixed(2);
    if (quantity >= category.min) {
      if(category.categoryAmount && category.percentage){
        category['zakatMessage'] = null;
        category['zakatAmount'] = ((category.categoryAmount * parseFloat(category.percentage)) / 100).toFixed(2);
      }
        
      // this.totalZakatAmount = this.totalZakatAmount + parseFloat(category['zakatAmount']);
    } else {
      category['zakatAmount'] = 0;
      category['zakatMessage'] = " No Zakat (Min Quantity " + category.min + " " + category.units + ".)";
    }

    // quantity * this.GramGoldPrice;
    // if(quantity >= parseFloat(category.in)){
    //   // 
    //   return quantity * this.GramGoldPrice;
    // }else{
    //   return "No Zakat";
    // }

    // let zakatForm.controls[category.id_category].value 

    // this.zakatForm.addControl(category.id_category.toString(), new FormControl('no'));
    //     this.zakatForm.addControl(category.id_category.toString()+'_quantity', new FormControl(''));
    this.totalZakatAmount = 0;
    this.categoryList.forEach((cat: any) => {
      if(cat['zakatAmount']){
        this.totalZakatAmount = this.totalZakatAmount + parseFloat(cat['zakatAmount']);
      }
    });
  }





}
