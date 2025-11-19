import YouTubePlayer from 'youtube-player';
import { extractYTVideoID } from '../utils';

export default class YtPlayer {
  constructor(block) {
    this.block = block;
    this.player = null;

    if (!this.block) return;

    this.init();
  }

  init() {
    const url = this.block.dataset.url;

    if (!url) {
      console.error('YouTube URL is not defined');
      return;
    }

    const videoId = extractYTVideoID(url);

    if (!videoId) {
      console.error('YouTube video ID not found');
      return;
    }

    this.player = YouTubePlayer(this.block, { playerVars: { autoplay: 0, controls: 1 } });

    if (!this.player) {
      console.error('YouTube player not initialized');
      return;
    }

    this.player.loadVideoById(videoId);

    this.player.on('ready', () => {
      this.player.pauseVideo();
    });
  }

  async startVideo() {
    const iframe = await this.player?.getIframe();
    iframe?.classList.remove('is-hidden');

    await this.player?.playVideo();
  }
}
