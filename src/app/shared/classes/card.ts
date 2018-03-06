export class Card {
	constructor (
		public cardId: string,
		public cardCategoryId: string,
		public cardAnswer: string,
		public cardPoints: number,
		public cardQuestion: string
) {}
}