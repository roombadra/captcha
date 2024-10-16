class PuzzleCaptcha extends HTMLElement {
    connectedCallback() {
        const width = parseInt(this.getAttribute('width'), 10);
        const height = parseInt(this.getAttribute('height'), 10);
        const pieceWidth = parseInt(this.getAttribute('piece-width'), 10);
        const pieceHeight = parseInt(this.getAttribute('piece-height'), 10);

        this.classList.add('captcha');

        this.style.setProperty('--width', `${width}px`);
        this.style.setProperty('--image', `url(${this.getAttribute('src')})`);
        this.style.setProperty('--height', `${height}px`);
        this.style.setProperty('--pieceWidth', `${pieceWidth}px`);
        this.style.setProperty('--pieceHeight', `${pieceHeight}px`);
    }
}

customElements.define('puzzle-captcha', PuzzleCaptcha)