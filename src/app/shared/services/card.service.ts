import {Injectable} from "@angular/core";

import {Status} from "../classes/status";
import {Card} from "../classes/card";
import {Observable} from "rxjs/Observable";
import {HttpClient} from "@angular/common/http";
import {BehaviorSubject} from "rxjs/BehaviorSubject";

@Injectable ()
export class CardService {
	card : Card = new Card(null, null, null, null, null);
	protected cardSubject : BehaviorSubject<Card> = new BehaviorSubject<Card>(this.card);

	public cardObserver : Observable<Card> = this.cardSubject.asObservable();

	constructor(protected http : HttpClient) {}

	// api endpoint
	private cardUrl = "api/card/";

	// call card API and delete the specific card
	deleteCard(cardId: number) : Observable<Status> {
		return(this.http.delete<Status>(this.cardUrl + cardId));
	}
	// call card API and update a card
	editCard(card: Card) : Observable<Status> {
		return(this.http.put<Status>(this.cardUrl + card.cardId, card));
	}

	// call card API and create a card
	createCard(card: Card) : Observable<Status> {
		return(this.http.post<Status>(this.cardUrl, card));
	}

	// call card API and get a card by card id
	getCard(cardId: string) : Observable<Card> {
		return(this.http.get<Card>(this.cardUrl + cardId));
	}

	// call card API and get cards by card category id
	getCardByCardCategoryId(cardCategoryId: string) : Observable<Card[]> {
		return(this.http.get<Card[]>(this.cardUrl + "?cardCategoryId=" + cardCategoryId));
	}

	// call card API and get cards by card points
	getCardByCardPoints(cardPoints: number) : Observable<Card[]> {
		return(this.http.get<Card[]>(this.cardUrl + cardPoints));
	}


}