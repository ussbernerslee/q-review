import {Injectable} from "@angular/core";
import {HttpClient, HttpParams} from "@angular/common/http";

import {Status} from "../classes/status";
import {Board} from "../classes/board";
import {Observable} from "rxjs/Observable";

@Injectable ()
export class BoardService {

	constructor(protected http : HttpClient) {}

		//api endpoint
		private boardUrl = "api/board/";

		//call to the board API and create the board
		createBoard(board: Board) : Observable<Status> {
			return(this.http.post<Status>(this.boardUrl , board));
		}

		//call the board API and get a Board object by its Id
		getBoard(boardId: string) : Observable<Board> {
			return(this.http.get<Board>(this.boardUrl, {params: new HttpParams().set("boardId", boardId)}));
		}

		//call the board API and get the Board by Board Profile Id
		getBoardByBoardProfileId(boardProfileId: string) : Observable<Board> {

			return(this.http.get<Board>(this.boardUrl, {params: new HttpParams().set("boardProfileId", boardProfileId)}));
		}

	}
