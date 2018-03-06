// the version on top is for PUBNUB,
/*import {Component} from "@angular/core";

@Component({
  selector: "pubnub-open-a-channel",
  template: require("./app.component.html")
})

export class AppComponent {}
*/


//the version below is from gkephart's example: ng-templating-needs to be changed for KMaru's views

//import needed @angularDependencies
import {RouterModule, Routes} from "@angular/router";


//import all needed components
import {AboutComponent} from "./about/about.component";
import {HomeComponent} from "./home/home.component";



// import all needed Services
import {CookieService} from "ng2-cookies";
import {SessionService} from "./shared/services/session.service";
import {PostService} from "./shared/services/post.service";

//import all needed Interceptors
import {APP_BASE_HREF} from "@angular/common";
import {HTTP_INTERCEPTORS} from "@angular/common/http";
import {DeepDiveInterceptor} from "./shared/interceptors/deep.dive.interceptor";



//an array of the components that will be passed off to the module
export const allAppComponents = [ HomeComponent, AboutComponent];

//an array of routes that will be passed of to the module
export const routes: Routes = [
  {path: "", component: HomeComponent},
  {path: "about", component: AboutComponent}


];

// an array of services
const services : any[] = [CookieService, SessionService , PostService];

// an array of misc providers
const providers : any[] = [
  {provide: APP_BASE_HREF, useValue: window["_base_href"]},
  {provide: HTTP_INTERCEPTORS, useClass: DeepDiveInterceptor, multi: true}

];

export const appRoutingProviders: any[] = [providers, services];

export const routing = RouterModule.forRoot(routes);

