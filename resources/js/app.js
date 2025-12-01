import './bootstrap';

// Dynamic import of jquery and slick (safe: won't break if packages aren't installed)
(async function () {
	document.addEventListener('DOMContentLoaded', async function () {
		let $ = null;
		try {
			const jqueryModule = await import('jquery');
			$ = jqueryModule.default || window.jQuery || window.$;
			if (!$) {
				// if still not available, set from module
				window.$ = window.jQuery = jqueryModule.default || jqueryModule;
				$ = window.$;
			}
			await import('slick-carousel');
			await import('slick-carousel/slick/slick.css');
			await import('slick-carousel/slick/slick-theme.css');
		} catch (err) {
			// jquery or slick not installed — rely on CDN fallback if present
			// console.warn('local jquery/slick not installed, using CDN fallback');
		}

		if (window.$ && $.fn && $.fn.slick) {
			window.$('.companies-slider').slick({ dots: false, infinite: true, slidesToShow: 4, slidesToScroll: 1, arrows: false, autoplay: true, speed: 2000, autoplaySpeed: 2000, cssEase: 'linear', responsive: [{ breakpoint: 1024, settings: { slidesToShow: 4 } }, { breakpoint: 700, settings: { slidesToShow: 2 } }, { breakpoint: 500, settings: { slidesToShow: 1 } }] });
			window.$('.courses-slider').slick({ dots: false, infinite: true, slidesToShow: 3, slidesToScroll: 1, arrows: false, autoplay: true, speed: 500, cssEase: 'linear', responsive: [{ breakpoint: 1200, settings: { slidesToShow: 2 } }, { breakpoint: 600, settings: { slidesToShow: 1 } },],});
			window.$('.mentor-slider').slick({ dots: false, infinite: true, slidesToShow: 3, slidesToScroll: 1, arrows: false, autoplay: true, cssEase: 'linear', responsive: [{ breakpoint: 1200, settings: { slidesToShow: 3 } }, { breakpoint: 1000, settings: { slidesToShow: 2 } }, { breakpoint: 530, settings: { slidesToShow: 1 } },],});
			window.$('.testimonial-slider').slick({ dots: true, infinite: true, slidesToShow: 3, slidesToScroll: 2, arrows: false, autoplay: true, cssEase: 'linear', responsive: [{ breakpoint: 1200, settings: { slidesToShow: 3 } }, { breakpoint: 800, settings: { slidesToShow: 2 } }, { breakpoint: 600, settings: { slidesToShow: 1 } },],});
		}

		// Header toggles - use Vanilla JS when possible
		const hamburgerBtn = document.getElementById('hamburger-btn');
		const mobileMenu = document.getElementById('mobile-menu');
		const mobileClose = document.getElementById('mobile-close');
		if (hamburgerBtn && mobileMenu) {
			hamburgerBtn.addEventListener('click', function () {
				mobileMenu.classList.toggle('translate-x-full');
			});
		}

		// Colorful gradient press effect on history nav links
		document.querySelectorAll('.history-link').forEach(link => {
			link.addEventListener('mousedown', function (e) {
				link.classList.add('pressed');
				setTimeout(() => link.classList.remove('pressed'), 700);
			});
			link.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					link.classList.add('pressed');
					setTimeout(() => link.classList.remove('pressed'), 700);
				}
			});
		});
		if (mobileClose && mobileMenu) {
			mobileClose.addEventListener('click', function () {
				mobileMenu.classList.add('translate-x-full');
			});
		}

		// --- Survey form enhancements ---
		// Auto-resize textarea
		document.querySelectorAll('form textarea').forEach(function (ta) {
			ta.addEventListener('input', function () {
				ta.style.height = 'auto';
				ta.style.height = (ta.scrollHeight) + 'px';
			});
		});
		// Focus effect for floating label
		document.querySelectorAll('form input, form textarea').forEach(function (el) {
			el.addEventListener('focus', function () {
				el.classList.add('ring-2', 'ring-[#7c6f57]');
			});
			el.addEventListener('blur', function () {
				el.classList.remove('ring-2', 'ring-[#7c6f57]');
			});
		});

		// --- Topic tag & suggestions widget (run once) ---
		try {
			(function setupTopicWidget() {
				const suggestions = [
					'Sejarah Indonesia',
					'Sejarah Dunia',
					'Filsafat Sejarah',
					'Sejarah Asia Tenggara',
					'Sejarah Politik',
					'Sejarah Ekonomi',
					'Sejarah Peradaban',
				];

				const input = document.getElementById('topic_interest');
				const hiddenInput = document.getElementById('topic_interest_hidden');
				const chipsContainer = document.getElementById('topic-chips');
				const suggestionsEl = document.getElementById('topic-suggestions');
				if (!input || !hiddenInput || !chipsContainer || !suggestionsEl) return;

				let selected = [];
				let suggestionIndex = -1;

				function updateHidden() {
					hiddenInput.value = selected.join(', ');
				}

				function renderChips() {
					chipsContainer.innerHTML = '';
					selected.forEach((t, idx) => {
						const chip = document.createElement('div');
						chip.className = 'inline-flex items-center gap-2 bg-[#f3ecd9] text-[#7c6f57] px-3 py-1 rounded-full border border-[#e9d8a6] text-sm';
						chip.innerHTML = `<span>${t}</span><button type="button" aria-label="Hapus ${t}" data-index="${idx}" class="ml-2 text-[#a68b5b] hover:text-[#7c6f57]">&times;</button>`;
						chipsContainer.appendChild(chip);
					});
					updateHidden();
				}

				function addTag(tag) {
					tag = tag.trim();
					if (!tag) return;
					// avoid duplicates
					if (selected.includes(tag)) return;
					selected.push(tag);
					renderChips();
				}

				function removeTag(idx) {
					selected.splice(idx, 1);
					renderChips();
				}

				function showSuggestions(pat) {
					suggestionsEl.innerHTML = '';
					const filtered = suggestions.filter(s => s.toLowerCase().includes(pat.toLowerCase()) && !selected.includes(s));
					if (!filtered.length) {
						suggestionsEl.classList.add('hidden');
						suggestionIndex = -1;
						return;
					}
					filtered.forEach((s, i) => {
						const li = document.createElement('li');
						li.className = 'px-4 py-2 hover:bg-[#f5f1e7] cursor-pointer';
						li.textContent = s;
						li.addEventListener('click', function () {
							addTag(s);
							input.value = '';
							hideSuggestions();
							input.focus();
						});
						suggestionsEl.appendChild(li);
					});
					suggestionIndex = -1;
					suggestionsEl.classList.remove('hidden');
				}

				function hideSuggestions() {
					suggestionsEl.classList.add('hidden');
					suggestionIndex = -1;
				}

				input.addEventListener('input', function () {
					const val = input.value.trim();
					if (!val) {
						hideSuggestions();
						return;
					}
					showSuggestions(val);
				});

				input.addEventListener('keydown', function (e) {
					// Enter to add tag
					if (e.key === 'Enter') {
						e.preventDefault();
						const val = input.value.trim();
						if (val) {
							addTag(val);
							input.value = '';
							hideSuggestions();
						}
					}
					// Arrow navigation
					if (e.key === 'ArrowDown' && !suggestionsEl.classList.contains('hidden')) {
						e.preventDefault();
						const items = suggestionsEl.querySelectorAll('li');
						if (!items.length) return;
						suggestionIndex = Math.min(suggestionIndex + 1, items.length - 1);
						items.forEach(it => it.classList.remove('bg-[#f5f1e7]'));
						items[suggestionIndex].classList.add('bg-[#f5f1e7]');
					}
					if (e.key === 'ArrowUp' && !suggestionsEl.classList.contains('hidden')) {
						e.preventDefault();
						const items = suggestionsEl.querySelectorAll('li');
						if (!items.length) return;
						suggestionIndex = Math.max(suggestionIndex - 1, 0);
						items.forEach(it => it.classList.remove('bg-[#f5f1e7]'));
						items[suggestionIndex].classList.add('bg-[#f5f1e7]');
					}
					if (e.key === 'Tab' || e.key === 'Escape') {
						hideSuggestions();
					}
					// Enter to accept highlighted suggestion
					if (e.key === 'Enter' && !suggestionsEl.classList.contains('hidden') && suggestionIndex >= 0) {
						const items = suggestionsEl.querySelectorAll('li');
						e.preventDefault();
						if (items[suggestionIndex]) {
							addTag(items[suggestionIndex].textContent);
							input.value = '';
							hideSuggestions();
						}
					}
					// Add on comma
					if (e.key === ',') {
						e.preventDefault();
						const val = input.value.trim();
						if (val) {
							addTag(val);
							input.value = '';
							hideSuggestions();
						}
					}
					// Backspace to remove last tag if empty
					if (e.key === 'Backspace' && input.value.length === 0 && selected.length > 0) {
						e.preventDefault();
						removeTag(selected.length - 1);
					}
				});

				// clicking a chip remove button
				chipsContainer.addEventListener('click', function (ev) {
					const btn = ev.target.closest('button[data-index]');
					if (!btn) return;
					const idx = Number(btn.getAttribute('data-index'));
					removeTag(idx);
				});
				// click outside to close suggestions
				document.addEventListener('click', function (ev) {
					const within = ev.composedPath ? ev.composedPath().includes(input) : ev.target === input || input.contains(ev.target);
					const withinSug = ev.composedPath ? ev.composedPath().includes(suggestionsEl) : suggestionsEl.contains(ev.target);
					if (!within && !withinSug) hideSuggestions();
				});
				// if anchor in url for topic, focus it
				if (window.location.hash === '#topic_interest' || window.location.search.indexOf('focus=topic') >= 0) {
					setTimeout(() => {
						const t = document.getElementById('topic_interest');
						if (t) { t.focus(); t.classList.add('animate-pulse'); setTimeout(() => t.classList.remove('animate-pulse'), 900); }
					}, 300);
				}
			})();
		} catch (err) {
			// widget didn't set up due to missing elements; ignore silently
		}
		// Sign-in modal toggles
		const signInBtn = document.getElementById('sign-in-btn');
		const signUpBtn = document.getElementById('sign-up-btn');
		const modalSignIn = document.getElementById('modal-signin');
		const modalSignUp = document.getElementById('modal-signup');
		const modalSignInClose = document.getElementById('modal-signin-close');
		const modalSignUpClose = document.getElementById('modal-signup-close');

		if (signInBtn && modalSignIn) {
			signInBtn.addEventListener('click', function (e) {
				// If sign-in element is an anchor to the login page, don't open modal.
				if (signInBtn.tagName === 'A' && signInBtn.getAttribute('href') && signInBtn.getAttribute('href') !== '#') return;
				e.preventDefault();
				modalSignIn.classList.remove('hidden');
			});
		}
		if (modalSignInClose && modalSignIn) {
			modalSignInClose.addEventListener('click', function () {
				modalSignIn.classList.add('hidden');
			});
		}
		if (signUpBtn && modalSignUp) {
			signUpBtn.addEventListener('click', function (e) {
				if (signUpBtn.tagName === 'A' && signUpBtn.getAttribute('href') && signUpBtn.getAttribute('href') !== '#') return;
				e.preventDefault();
				modalSignUp.classList.remove('hidden');
			});
		}
		if (modalSignUpClose && modalSignUp) {
			modalSignUpClose.addEventListener('click', function () {
				modalSignUp.classList.add('hidden');
			});
		}

		// Sticky header behavior
		const headerEl = document.querySelector('header');
		function toggleSticky() {
			if (!headerEl) return;
			if (window.scrollY >= 80) {
				headerEl.classList.add('shadow-lg');
				headerEl.classList.add('py-5');
				headerEl.classList.remove('py-6');
			} else {
				headerEl.classList.remove('shadow-lg');
				headerEl.classList.remove('py-5');
				headerEl.classList.add('py-6');
			}
		}
		window.addEventListener('scroll', toggleSticky);

		// Ripple effect on elements with class .ripple
		document.querySelectorAll('.ripple').forEach(function (el) {
				el.addEventListener('click', function (ev) {
						const ink = document.createElement('span');
						ink.className = 'ripple-ink';
						const rect = el.getBoundingClientRect();
						const size = Math.max(rect.width, rect.height) * 2;
						ink.style.width = ink.style.height = size + 'px';
						ink.style.left = (ev.clientX - rect.left - size / 2) + 'px';
						ink.style.top = (ev.clientY - rect.top - size / 2) + 'px';
						el.appendChild(ink);
						setTimeout(() => ink.remove(), 700);
				});
		});

		// Continent search & random button (Articles index)
		const continentSearch = document.getElementById('continent-search');
		const randomContinentBtn = document.getElementById('random-continent');
		if (continentSearch) {
			continentSearch.addEventListener('input', function (e) {
				const val = e.target.value.trim().toLowerCase();
				const cards = document.querySelectorAll('.articles-index .grid a');
				cards.forEach(card => {
					const text = card.textContent.trim().toLowerCase();
					if (!val || text.indexOf(val) >= 0) {
						card.classList.remove('hidden');
					} else {
						card.classList.add('hidden');
					}
				});
			});
		}

		// Country search & sort on continent page
		const countrySearch = document.getElementById('country-search');
		const sortAZBtn = document.getElementById('sort-az');
		if (countrySearch) {
			countrySearch.addEventListener('input', function (e) {
				const val = e.target.value.trim().toLowerCase();
				const cards = document.querySelectorAll('.countries-grid .country-card');
				cards.forEach(card => {
					const text = card.textContent.trim().toLowerCase();
					if (!val || text.indexOf(val) >= 0) {
						card.classList.remove('hidden');
					} else {
						card.classList.add('hidden');
					}
				});
			});
		}
		if (sortAZBtn) {
			sortAZBtn.addEventListener('click', function (e) {
				e.preventDefault();
				const grid = document.querySelector('.countries-grid');
				if (!grid) return;
				const items = Array.from(grid.querySelectorAll('.country-card'));
				// Toggle sort state
				const asc = sortAZBtn.getAttribute('aria-pressed') !== 'true';
				sortAZBtn.setAttribute('aria-pressed', asc ? 'true' : 'false');
				items.sort((a, b) => {
					const an = a.textContent.trim().toLowerCase();
					const bn = b.textContent.trim().toLowerCase();
					if (an === bn) return 0;
					return asc ? (an > bn ? 1 : -1) : (an < bn ? 1 : -1);
				});
				items.forEach(i => grid.appendChild(i));
			});
		}
		if (randomContinentBtn) {
			randomContinentBtn.addEventListener('click', function (e) {
				e.preventDefault();
				const cards = Array.from(document.querySelectorAll('.articles-index .grid a')).filter(a => !a.classList.contains('hidden'));
				if (!cards.length) return;
				const idx = Math.floor(Math.random() * cards.length);
				cards[idx].click();
			});
		}

		// Show continent options dropdown on 'Lihat' click
		document.querySelectorAll('.show-continent-options').forEach(btn => {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				const card = btn.closest('.continent-card');
				if (!card) return;
				const menu = card.querySelector('.continent-options');
				if (!menu) return;
				const expanded = btn.getAttribute('aria-expanded') === 'true';
				btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
				menu.classList.toggle('hidden');
				if (!expanded) {
					// Close other open menus
					document.querySelectorAll('.continent-options').forEach(m => { if (m !== menu) m.classList.add('hidden'); });
				}
			});
		});

		// Accent color mapping for continents (RGB)
		const continentAccentMap = {
			'asia': '234,179,8', // yellow
			'europe': '59,130,246', // blue
			'africa': '17,24,39', // black-ish
			'oceania': '16,185,129', // green
			'north-america': '239,68,68', // red
			'south-america': '239,68,68', // red
		};

		function triggerAccent(card) {
			if (!card) return;
			const continent = card.getAttribute('data-continent') || '';
			const rgb = continentAccentMap[continent] || '124,111,87';
			card.style.setProperty('--accent-rgb', rgb);
			card.classList.add('accent-active');
			card.classList.add('accent-pressed');
			// Remove after the animation completes
			setTimeout(() => {
				card.classList.remove('accent-active');
				card.classList.remove('accent-pressed');
			}, 900);
		}

		// Trigger effect when clicking the main card
		document.querySelectorAll('.continent-card').forEach(card => {
			card.addEventListener('mousedown', function (e) {
				// Do minor haptics on mousedown to show it's pressed
				triggerAccent(card);
			});
			// also support 'click' so users who click rather than mousedown see effect
			card.addEventListener('click', function (e) {
				triggerAccent(card);
			});
			// keyboard: Enter/Space to trigger accent and open the menu button if any
			card.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					triggerAccent(card);
					const btn = card.querySelector('.show-continent-options');
					if (btn) {
						btn.click();
						btn.focus();
					}
				}
			});
			// If a keyboard user presses Enter/Space on the 'Lihat' button we also trigger
			card.querySelectorAll('.show-continent-options, .continent-options a').forEach(el => {
				el.addEventListener('click', function (ev) {
					triggerAccent(card);
				});
			});
		});

		// Close wallets when clicking outside
		document.addEventListener('click', function (event) {
			if (event.key && event.key === 'Escape') {
				document.querySelectorAll('.continent-options').forEach(m => m.classList.add('hidden'));
				document.querySelectorAll('.show-continent-options').forEach(b => b.setAttribute('aria-expanded', 'false'));
				return;
			}
			if (event.target.closest('.continent-card') || event.target.closest('.show-continent-options') || event.target.closest('.continent-options')) return;
			document.querySelectorAll('.continent-options').forEach(m => m.classList.add('hidden'));
			document.querySelectorAll('.show-continent-options').forEach(b => b.setAttribute('aria-expanded', 'false'));
		});

		// Close on escape when any menu is open (key handler)
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') {
				document.querySelectorAll('.continent-options').forEach(m => m.classList.add('hidden'));
				document.querySelectorAll('.show-continent-options').forEach(b => b.setAttribute('aria-expanded', 'false'));
			}
		});

		// Floating shapes handler removed — keep interactions minimal and light

		// Premium parallax + inertia for hero image
		const heroContainer = document.querySelector('.hero-img-container');
		if (heroContainer) {
			const img = heroContainer.querySelector('.hero-kenburns-premium');
			let tx = 0, ty = 0, vx = 0, vy = 0, raf = null;
			function animate() {
				tx += (vx - tx) * 0.12;
				ty += (vy - ty) * 0.12;
				img.style.transform = `scale(1.04) translate(${tx}px, ${ty}px) rotate(${tx/12}deg)`;
				raf = requestAnimationFrame(animate);
			}
			heroContainer.addEventListener('mousemove', function (ev) {
				if (!img) return;
				const rect = heroContainer.getBoundingClientRect();
				vx = ((ev.clientX - rect.left) / rect.width - 0.5) * 18;
				vy = ((ev.clientY - rect.top) / rect.height - 0.5) * 12;
				if (!raf) animate();
			});
			heroContainer.addEventListener('mouseleave', function () {
				vx = 0; vy = 0;
				if (!raf) animate();
			});
		}
		
		// Autoscroll containers used for 'Today is History' rows
		(function setupAutoScroll() {
			const containers = document.querySelectorAll('.autoscroll-container');
			containers.forEach(container => {
				if (container.dataset.clone === 'true') return; // already initialized
				const speed = parseFloat(container.getAttribute('data-scroll-speed') || '0.6');
				// duplicate items for seamless loop
				const children = Array.from(container.children);
				children.forEach(c => container.appendChild(c.cloneNode(true)));
				container.dataset.clone = 'true';
				let paused = false;

				// Helper to wait for images within a container to load
				function imagesLoadedPromise(el) {
					const imgs = Array.from(el.querySelectorAll('img'));
					if (!imgs.length) return Promise.resolve();
					return Promise.all(imgs.map(img => {
						return new Promise(resolve => {
							if (img.complete && img.naturalWidth !== 0) return resolve();
							img.addEventListener('load', resolve);
							img.addEventListener('error', resolve);
						});
					}));
				}

				// Compute originalWidth after images finish loading to ensure accurate width
				imagesLoadedPromise(container).then(() => {
					const originalWidth = container.scrollWidth / 2;
					container.dataset.originalWidth = String(originalWidth);
					function step() {
						if (!paused) {
							container.scrollLeft += Math.max(0.25, speed);
							if (container.scrollLeft >= originalWidth) {
								container.scrollLeft -= originalWidth;
							}
						}
						requestAnimationFrame(step);
					}
					requestAnimationFrame(step);
				});
				container.addEventListener('mouseenter', () => paused = true);
				container.addEventListener('mouseleave', () => paused = false);
				// step function started after image load; not called here
			});
		})();

		// Animate search button on click/focus
		document.querySelectorAll('button[aria-label="Cari"]').forEach(btn => {
			btn.classList.add('home-search-btn');
			btn.addEventListener('click', function (ev) {
				// if there's a search input, ensure pressing the button focuses it
				const wrapper = btn.closest('div');
				if (wrapper) {
					const input = wrapper.querySelector('input[name="q"]');
					if (input) input.focus();
				}
				btn.classList.add('animate-pulse');
				setTimeout(() => btn.classList.remove('animate-pulse'), 600);
			});
			btn.addEventListener('focus', function () {
				btn.classList.add('ring-2', 'ring-[#e9d8a6]');
			});
			btn.addEventListener('blur', function () {
				btn.classList.remove('ring-2', 'ring-[#e9d8a6]');
			});
		});

		// ensure tags are put into hidden input on form submit
		const surveyForm = document.querySelector('form[action$="survey.store"]') || document.querySelector('form');
		if (surveyForm) {
			surveyForm.addEventListener('submit', function (ev) {
				const h = document.getElementById('topic_interest_hidden');
				const chips = document.getElementById('topic-chips');
				if (h && chips) {
					const tags = Array.from(chips.querySelectorAll('div')).map(d => d.querySelector('span') ? d.querySelector('span').textContent : '').filter(Boolean);
					h.value = tags.join(', ');
				}

				// password visibility toggle removed to keep UI simple and accessible
			});
		}
	});
})();
