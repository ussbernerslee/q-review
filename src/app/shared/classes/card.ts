export class Card {
	constructor (
		public cardId: number,
		public cardCategoryId: number,
		public cardAnswer: string,
		public cardPoints: number,
		public cardQuestion: string
) {}
}