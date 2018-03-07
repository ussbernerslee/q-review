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

//import services
//import {ConstituentService} from "./shared/services/constituent.service";
//import {SenatorService} from "./shared/services/senator.service";
import {BoardService} from "./shared/services/board.service";
import {SessionService} from "./shared/services/session.service";


//import interceptors
import {DeepDiveInterceptor} from "./shared/interceptors/deep.dive.interceptor";
import {APP_BASE_HREF} from "@angular/common";
import {LedgerService} from "./shared/services/ledger.service";
import {CategoryService} from "./shared/services/category.service";

//create array of components
export const allAppComponents = [
	HomeComponent,
	BoardComponent,
	LeaderboardComponent
	//ConstituentComponent,
	//SenatorComponent,
	//SplashComponent
];

//setup routes
export const routes: Routes = [
	{path: "", component: HomeComponent},
	{path: "board", component: BoardComponent},
	{path: "leaderboard", component: LeaderboardComponent}
	//{path: "constituent", component: ConstituentComponent},
	//{path: "senator", component: SenatorComponent},
	//{path: "", component: SplashComponent}
];

//create array of services
const services: any[] = [
	BoardService,
	SessionService
];

//array of providers
export const providers: any[] = [
	{provide: APP_BASE_HREF, useValue: window["_base_href"]},
	{provide: HTTP_INTERCEPTORS, useClass: DeepDiveInterceptor, multi: true},
	LedgerService,
	BoardService,
	CategoryService,
	PubNubAngular
];

export const appRoutingProviders: any[] = [providers, services];

export const routing = RouterModule.forRoot(routes);