class Slider {

	/**
	 * @param  {HTMLElement} element
	 * @param  {Object} options
	 * @param  {Object} options.slidesToScroll Nombre d'éléments à faire défiler
	 * @param  {Object} options.slidesVisible  Nombre d'éléments visible dans un slide
	 */
	constructor (element, options = {})
	{
		this.element = element;
		this.options = Object.assign({}, {
			slidesToScroll: 1,
			slidesVisible: 1
		}, options);
		let children = [].slice.call(element.children);
		this.currentItem = 0;
		this.root = this.createDivWithClass('slider');
		this.container = this.createDivWithClass('slider-container');
		this.root.appendChild(this.container);
		this.element.appendChild(this.root);
		this.items = children.map((child) => {
			let item = this.createDivWithClass('slider-item');
			item.appendChild(child);
			this.container.appendChild(item);
			return item;
		});
		this.setStyle();
		this.createNavigation();
	}

	/**
	 * Applique les bonnes dimensions aux éléments du slider.
	 */
	setStyle () 
	{
		let ratio = this.items.length / this.options.slidesVisible;
		this.container.style.width = (ratio * 100) + "%";
		this.items.forEach(item => item.style.width = ((100 / this.options.slidesVisible) / ratio) + "%");
	}

	createNavigation ()
	{
		let nextButton = this.createDivWithClass('slider-next');
		let prevButton = this.createDivWithClass('slider-prev');
		this.root.appendChild(nextButton);
		this.root.appendChild(prevButton);
		nextButton.innerHTML = '<i class="fas fa-angle-right fa-2x"></i>';
		prevButton.innerHTML = '<i class="fas fa-angle-left fa-2x"></i>';
		nextButton.addEventListener('click', this.next.bind(this));
		prevButton.addEventListener('click', this.prev.bind(this));
	}

	next ()
	{
		this.gotoItem(this.currentItem + this.options.slidesToScroll);
	}

	prev ()
	{
		this.gotoItem(this.currentItem - this.options.slidesToScroll);
	}

	/**
	 * Déplace le slider vers l'élément ciblé.
	 * @param {number}index
	 */
	gotoItem (index)
	{
		if (index < 0)
			index = this.items.length - this.options.slidesVisible;
		else if (index >= this.items.length || (this.items[this.currentItem + this.options.slidesVisible] === undefined) && index > this.currentItem)
			index = 0;
		let translateX = index * -100 / this.items.length;
		this.container.style.transform = 'translate3d(' + translateX + '%, 0, 0)';
		this.currentItem = index;
	}

	/**
	 * @param  {string} className
	 * @return { HTMLElement}
	 */
	createDivWithClass (className)
	{
		let div = document.createElement('div');
		div.setAttribute('class', className);
		return div;
	}
};

/**
 * Instanciation de l'objet Slider.
 */
document.addEventListener('DOMContentLoaded', function ()
{
	let width = document.documentElement.clientWidth;
	if (width > 991)
	{
		new Slider(document.querySelector('#slider1'), {
			slidesToScroll: 1,
			slidesVisible: 5
		});
	}
	else if (width <= 991 && width > 767)
	{
		new Slider(document.querySelector('#slider1'), {
			slidesToScroll: 1,
			slidesVisible: 4
		});
	}
	else if (width <= 766 && width > 420)
	{
		new Slider(document.querySelector('#slider1'), {
			slidesToScroll: 1,
			slidesVisible: 3
		});
	}
	else
	{
		new Slider(document.querySelector('#slider1'), {
			slidesToScroll: 1,
			slidesVisible: 2
		});
	}
});