import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";
import {Status} from "../classes/status";
import {Observable} from "rxjs/Observable";
import {Join} from "../classes/join";

@Injectable()


export class JoinService {


	constructor(protected http:HttpClient) {}

	private sessionUrl = "api/join/";

	joinBoard(boardId : string): Observable<Status> {
		let board = new Join(boardId);
		return (this.http.post<Status>(this.sessionUrl, board));


	}

}