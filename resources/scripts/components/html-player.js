export default class HtmlPlayer {
  constructor(player) {
    this.player = player;

    this.init();
  }

  init() {
    if (!this.player) {
      console.error('HTML player element not found');
      return;
    }
  }

  async startVideo() {
    this.player?.classList.remove('is-hidden');
    await this.player?.play();
  }
}
