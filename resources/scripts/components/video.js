import YtPlayer from './yt-player.js';
import HtmlPlayer from './html-player.js';

export default class Video {
  constructor(block) {
    this.block = block;
    this.player = null;

    if (!this.block) return;

    this.init();
  }

  handleVideoPlay() {
    this.videoPoster.classList.remove('is-visible');
    this.playBtn.classList.remove('is-visible');

    this.player.startVideo();

    this.playBtn.removeEventListener('click', this.handleVideoPlay);

    this.playBtn.remove();
    this.videoPoster.remove();
  }

  init() {
    const players = [
      { selector: '.video__yt', PlayerClass: YtPlayer },
      { selector: '.video__html', PlayerClass: HtmlPlayer },
    ];

    for (const { selector, PlayerClass } of players) {
      const element = this.block.querySelector(selector);

      if (element) {
        this.player = new PlayerClass(element);
        break;
      }
    }

    this.playBtn = this.block.querySelector('.video-play-btn');
    this.videoPoster = this.block.querySelector('.video-poster');

    if (this.playBtn && this.videoPoster) {
      this.playBtn.addEventListener('click', this.handleVideoPlay.bind(this));
    }
  }
}
