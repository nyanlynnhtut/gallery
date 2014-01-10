# Gallery Module

Reborn CMS Gallery Module.

## Slider Usage.

Gallery module supported (3) type of slider.
- [Bootstrap 3](http://getbootstrap.com/javascript/#carousel)
- [SlideJs 3](http://www.slidesjs.com/)
- [GlideJs](https://github.com/jedrzejchalubek/Glide.js)

### Bootstrap Carousel Slider

The slideshow will be show carousel slider with Pagination (Indicators), Controls (Prev, Next) and Caption (<h3>Image Label</h3><p>Image Description</p>).

	// Default
	{{ Gallery::bootstrap('My Gallery') }}

	// With custom width and height (560x320)
	{{ Gallery::bootstrap('My Gallery', 560, 320) }}

	// Without pagination (indicators)
	{{ Gallery::bootstrap('My Gallery')->pagi(false) }}

	// Without controls (prev, next)
	{{ Gallery::bootstrap('My Gallery')->control(false) }}

	// Without caption
	{{ Gallery::bootstrap('My Gallery')->caption(false) }}

	// Without caption and pagination
	{{ Gallery::bootstrap('My Gallery')->caption(false)->pagi(false) }}

	// Set custom slider interval value
	{{ Gallery::bootstrap('My Gallery')->interval(4200) }}

### SlideJs

	TODO

### GlideJs

	TODO


