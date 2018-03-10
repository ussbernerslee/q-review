// remember to rename or replace the ConstituentComponent and SenatorComponent, SenatorService,ConstituentService,etc...
import {HTTP_INTERCEPTORS} from "@angular/common/http";
import {RouterModule, Routes} from "@angular/router";
import {PubNubAngular} from "pubnub-angular2";

// import components
//import {SplashComponent} from "./splash/splash.component";
//import {ConstituentComponent} from "./constituent/constituent.component";
//import {SenatorComponent} from "./senator/senator.component";
import {HomeComponent} from "./home/home.component";
import {BoardComponent} from "./board/board.component";
import {LeaderboardComponent} from "./leaderboard/leaderboard.component";
import {SignUpComponent} from "./signup/signup.component";
import {SignInComponent} from "./sign-in/sign-in.component";
import {CaptainComponent} from "./captain/captain.component";
import {CardComponent} from "./card/card.component";

//import services
//import {ConstituentService} from "./shared/services/constituent.service";
//import {SenatorService} from "./shared/services/senator.service";
import {BoardService} from "./shared/services/board.service";
import {SessionService} from "./shared/services/session.service";
import {LedgerService} from "./shared/services/ledger.service";
import {CategoryService} from "./shared/services/category.service";
import {CardService} from "./shared/services/card.service";
import {SignUpService} from "./shared/services/signup.service";
import {SignInService} from "./shared/services/sign.in.service";
import {AuthService} from "./shared/services/auth.service";
import {JwtHelperService} from "@auth0/angular-jwt";


//import interceptors
import {DeepDiveInterceptor} from "./shared/interceptors/deep.dive.interceptor";
import {APP_BASE_HREF} from "@angular/common";
import {CookieService} from "ng2-cookies";





//create array of components
export const allAppComponents = [
	HomeComponent,
	BoardComponent,
	LeaderboardComponent,
	SignUpComponent,
	SignInComponent,
	CardComponent,
	CaptainComponent
	//ConstituentComponent,
	//SenatorComponent,
	//SplashComponent
];

//setup routes
export const routes: Routes = [
	{path: "", component: HomeComponent},
	{path: "board", component: BoardComponent},
	{path: "leaderboard", component: LeaderboardComponent},
	{path: "signup", component: SignUpComponent},
	{path: "sign-in", component: SignInComponent},
	{path: "card", component: CardComponent},
	{path: "captain", component: CaptainComponent}
	//{path: "constituent", component: ConstituentComponent},
	//{path: "senator", component: SenatorComponent},
	//{path: "", component: SplashComponent}
];



//array of providers
export const providers: any[] = [
	{provide: APP_BASE_HREF, useValue: window["_base_href"]},
	{provide: HTTP_INTERCEPTORS, useClass: DeepDiveInterceptor, multi: true},
	LedgerService,
	BoardService,
	CategoryService,
	CardService,
	SignUpService,
	SignInService,
	CookieService,
	AuthService,
	SessionService,
	JwtHelperService,
	PubNubAngular
];

export const appRoutingProviders: any[] = [providers];

export const routing = RouterModule.forRoot(routes);