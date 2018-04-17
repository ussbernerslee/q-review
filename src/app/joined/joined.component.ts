import {Component, HostListener, OnInit} from "@angular/core";
import {PubNubAngular} from "pubnub-angular2";
import {ActivatedRoute} from "@angular/router";
import {AuthService} from "../shared/services/auth.service";


@Component({
	selector: "joined",
	template: require("./joined.html")
})

export class JoinedComponent implements OnInit {
	boardId: string;
	canBuzzIn: boolean = true;
	gameState: any = {};
	profileUsername: string = this.authService.decodeJwt().auth.profileUsername;

	constructor(protected authService: AuthService, protected pubnub: PubNubAngular, protected route: ActivatedRoute) {
		let parent = this;
		this.pubnub.init({
			publishKey: "pub-c-f4761826-34d5-4b1c-8977-ce66a5199a53",
			subscribeKey: "sub-c-4c7ad82a-141f-11e8-acae-aa071d12b3f5",
			ssl: true
		});
		this.pubnub.addListener({message: function(pubnubMessage: any) {
				if(pubnubMessage.message.queue && pubnubMessage.message.queue.length === 0) {
					parent.canBuzzIn = true;
				}
				if(pubnubMessage.message.cards && pubnubMessage.message.cards.length > 0) {
					parent.gameState = pubnubMessage.message;
				}
				console.log(pubnubMessage);
			}
		});
	}

	ngOnInit(): void {
		this.boardId = this.route.snapshot.params.boardId;
		this.pubnub.publish({message: "joined", channel: "kmaru-" + this.boardId});
		this.pubnub.subscribe({channels: ["kmaru-" + this.boardId]});
	}


	@HostListener("document:keypress", ["$event"])
	buzzInKeyboardEvent(keyEvent: KeyboardEvent): void {
		console.log(keyEvent);
		if(this.canBuzzIn === true && keyEvent.altKey === false && keyEvent.ctrlKey === false && keyEvent.metaKey == false && keyEvent.repeat === false && (keyEvent.key === "f" || keyEvent.key === "F")) {
			this.buzzIn();
		}
	}

	buzzIn(): void {
		this.canBuzzIn = false;
		this.pubnub.publish({message: {command: "buzz-in", username: this.profileUsername}, channel: "kmaru-" + this.boardId});
	}
}