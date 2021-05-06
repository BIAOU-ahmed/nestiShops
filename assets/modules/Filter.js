import { Flipper, spring } from 'flip-toolkit'

/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLFormElement} form
 */
export default class Filter {

    /**
     * 
     * @param {HTMLElement|null} element 
     */
    constructor(element) {
        if (element === null) {
            return
        }
        this.pagination = element.querySelector('.js-filter-pagination')
        this.content = element.querySelector('.js-filter-content')
        this.form = element.querySelector('.js-filter-form')
        console.log('je me construi');

        this.bindEvents()
    }

    /**
     * ADD actions to the components
     */
    bindEvents() {
        const OnClickPagination = e => {
            if (e.target.tagName === 'A') {
                e.preventDefault()
                this.loadUrl(e.target.getAttribute('href'))
            }
        }
        this.form.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this))
        })
        this.pagination.addEventListener('click', OnClickPagination)
    }

    async loadForm() {
        const data = new FormData(this.form)
        const url = new URL(this.form.getAttribute('action') || window.location.href)
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            params.append(key, value)
        })
        return this.loadUrl(url.pathname + '?' + params.toString())
    }
    async loadUrl(url) {
        this.showLoader();
        const params = new URLSearchParams(url.split('?')[1] || '')
        params.set('ajax', 1)
        console.log('my new  url', url)
        const response = await fetch(url.split('?')[0] + '?' + params.toString(), {
            headers: {
                'X-Requested-with': 'XMLHttpRequest'
            }
        })
        if (response.status >= 200 && response.status < 300) {
            const data = await response.json()
            this.pagination.innerHTML = data.pagination
            this.flipContent(data.content)
            params.delete('ajax')
            history.replaceState({}, '', url.split('?')[0] + '?' + params.toString())

        } else {
            console.log(response);
        }
        this.hideLoader()
    }

    /**
     * replace grid element with effect
     * @param {string} content 
     */
    flipContent(content) {
        const springConfig = 'gentle'
        const exitSpring = function(element, index, onComplete) {
            spring({
                config: 'stiff',
                values: {
                    translateY: [0, -20],
                    opacity: [1, 0]
                },
                onUpdate: ({ translateY, opacity }) => {
                    element.style.opacity = opacity;
                    element.style.transform = `translateY(${translateY}px)`;
                },
                onComplete
            });
        }
        const appearSpring = function(element, index) {
            spring({
                config: 'stiff',
                values: {
                    translateY: [20, 0],
                    opacity: [0, 1]
                },
                onUpdate: ({ translateY, opacity }) => {
                    element.style.opacity = opacity;
                    element.style.transform = `translateY(${translateY}px)`;
                },
                delay: index * 20
            });
        }
        console.log('in flipped ');
        const flipper = new Flipper({
            element: this.content

        })
        this.content.children.forEach(element => {
            flipper.addFlipped({
                element,
                spring: springConfig,
                flipId: element.id,
                shouldFlip: false,
                onExit: exitSpring
            })
        })
        flipper.recordBeforeUpdate()
        this.content.innerHTML = content

        this.content.children.forEach(element => {
            flipper.addFlipped({
                element,
                spring: springConfig,
                flipId: element.id,
                onAppear: appearSpring
            })
        })
        flipper.update()
    }

    showLoader() {
        this.form.classList.add('is-loading')
        const loader = this.form.querySelector('.js-loading')

        if (loader === null) {
            return
        }

        loader.setAttribute('aria-hidden', 'false')
        loader.style.display = null;
    }
    hideLoader() {
        this.form.classList.remove('is-loading')
        const loader = this.form.querySelector('.js-loading')

        if (loader === null) {
            return
        }

        loader.setAttribute('aria-hidden', 'true')
        loader.style.display = 'none';
    }

}