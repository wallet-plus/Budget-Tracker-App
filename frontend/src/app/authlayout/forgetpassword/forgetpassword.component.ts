import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-forgetpassword',
  templateUrl: './forgetpassword.component.html',
  styleUrls: ['./forgetpassword.component.scss']
})
export class ForgetpasswordComponent {

  forgotPasswordForm: FormGroup = this.fb.group({
    email: ['', [Validators.required, Validators.pattern(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)]],
  });
  
  constructor(private _authService: AuthService,private fb: FormBuilder, private router: Router) { }


  
  onSubmit() {
    if (this.forgotPasswordForm.valid) {
      this._authService.forgotPassword(this.forgotPasswordForm.controls['email'].value).subscribe(
        (response) => {
          // localStorage.setItem("accessToken", response.accessToken);
          // this.router.navigateByUrl('/dashboard');
        },(error) => {
          // Navigate to the confirmation required page
          // this._router.navigateByUrl('/confirmation-required');
        },
      );
      // localStorage.setItem("token","login");
      // this.router.navigateByUrl('auth/reset-password/token');
      // Handle form submission
    }
  }

}
