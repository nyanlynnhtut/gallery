# Gallery Module

Gallery Management and slider module for [Reborn CMS](http://reborncms.com). Current version is 1.2

## Slider Usage.

Gallery module supported (3) type of slider.
- [Bootstrap 3](http://getbootstrap.com/javascript/#carousel) (Since version 1.0)
- [SlideJs 3](http://www.slidesjs.com/) (Since version 1.0)
- [GlideJs](https://github.com/jedrzejchalubek/Glide.js) (Since version 1.0)
- [Flux Slider](http://www.joelambert.co.uk/flux/) (Since version 1.2)

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

### SlideJs (website : http://www.slidesjs.com/)

	// Default
	{{ Gallery::slidejs('My Gallery') }}

	// With custom width and height (560x320)
	{{ Gallery::slidejs('My Gallery', 560, 320) }}

	// Use slide js with "fade" effect and effect speed
	{{ Gallery::slidejs('My Gallery')->fade(900) }}

	// Use slide js with "slide" effect and effect speed
	{{ Gallery::slidejs('My Gallery')->slide(600) }}

	// Slide with autoplay (1st param), play interval time(2nd param) and pause on hove
	{{ Gallery::slidejs('My Gallery')->play(true, 5000, false) }}

	// You can use options setting with chain method
	{{ Gallery::slidejs('My Gallery')->slide(600)->play(true, 5000, false) }}

### GlideJs (website : http://jedrzejchalubek.com/glide/)

	// Default
	{{ Gallery::glidejs('My Gallery') }}

	// With custom width and height (560x320)
	{{ Gallery::glidejs('My Gallery', 560, 320) }}

	// Glide js with navigation show (1st param) and position center
	{{ Gallery::glidejs('My Gallery')->nav($show = true, $center = true) }}

	// Glide js with prev, next arrow
	{{ Gallery::glidejs('My Gallery')->arrows($show = true, $left = 'Prev', $right = 'Next') }}

	// You can use options setting with chain method
	{{ Gallery::glidejs('My Gallery')->nav(true, true)->arrows(true, 'Prev', 'Next') }}

### Flux Slider (website : http://www.joelambert.co.uk/flux/)

	// Default
	{{ Gallery::flux('My Gallery') }}

	// With custom width and height (560x320)
	{{ Gallery::flux('My Gallery', 560, 320) }}

	// With pagination (indicators)
	{{ Gallery::flux('My Gallery')->pagi(true) }}

	// With controls (Prev and Next Button)
	{{ Gallery::flux('My Gallery')->controls(true) }}

	// With captions (Caption text will be use Gallery image label attribute.)
	{{ Gallery::captions('My Gallery')->captions(true) }}

	// Set custom delay (Delay is the number of milliseconds to wait between image transitions.)
	{{ Gallery::flux('My Gallery')->delay(5000) }}

	// Set custom transitions (See supported transation at DocBlock)
	{{ Gallery::flux('My Gallery')->transitions(['bars', 'zips']) }}

	// You can use options setting with chain method
	{{ Gallery::flux('My Gallery')->pagi(true)->controls(true) }}