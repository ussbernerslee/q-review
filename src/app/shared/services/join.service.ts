import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";
import {Status} from "../classes/status";
import {Observable} from "rxjs/Observable";

@Injectable()


export class SessionService {


	constructor(protected http:HttpClient) {}

	private sessionUrl = "api/join/";

	joinBoard(boardId : string): Observable<Status> {
		return (this.http.post<Status>(this.sessionUrl, boardId));

	}

}