<!DOCTYPE html>

<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>UMKM Market - Supporting Local Artisans</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100..900&display=swap" rel="stylesheet"/>
<!-- Tailwind Configuration -->
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "tertiary-fixed": "#ffdbcb",
                    "secondary-fixed-dim": "#adc6ff",
                    "outline": "#757682",
                    "secondary-fixed": "#d8e2ff",
                    "tertiary-container": "#6e2c00",
                    "surface-variant": "#e1e2e4",
                    "inverse-on-surface": "#f0f1f3",
                    "secondary-container": "#2170e4",
                    "error-container": "#ffdad6",
                    "on-primary-fixed-variant": "#264191",
                    "inverse-surface": "#2e3132",
                    "primary-fixed-dim": "#b6c4ff",
                    "primary-fixed": "#dce1ff",
                    "on-error-container": "#93000a",
                    "on-primary": "#ffffff",
                    "surface-tint": "#4059aa",
                    "surface-container-low": "#f3f4f6",
                    "background": "#f8f9fb",
                    "surface-container-highest": "#e1e2e4",
                    "secondary": "#0058be",
                    "surface-dim": "#d9dadc",
                    "on-primary-container": "#90a8ff",
                    "surface-bright": "#f8f9fb",
                    "tertiary-fixed-dim": "#ffb691",
                    "on-tertiary-fixed-variant": "#773205",
                    "primary-container": "#1e3a8a",
                    "error": "#ba1a1a",
                    "on-surface": "#191c1e",
                    "outline-variant": "#c5c5d3",
                    "surface": "#f8f9fb",
                    "on-surface-variant": "#444651",
                    "surface-container-high": "#e7e8ea",
                    "surface-container-lowest": "#ffffff",
                    "inverse-primary": "#b6c4ff",
                    "on-tertiary": "#ffffff",
                    "primary": "#00236f",
                    "on-background": "#191c1e",
                    "tertiary": "#4b1c00",
                    "surface-container": "#edeef0",
                    "on-secondary-container": "#fefcff",
                    "on-primary-fixed": "#00164e",
                    "on-error": "#ffffff",
                    "on-secondary-fixed-variant": "#004395",
                    "on-tertiary-fixed": "#341100",
                    "on-tertiary-container": "#f39461",
                    "on-secondary-fixed": "#001a42",
                    "on-secondary": "#ffffff"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "margin-mobile": "16px",
                    "sm": "8px",
                    "xs": "4px",
                    "2xl": "48px",
                    "md": "16px",
                    "xl": "32px",
                    "3xl": "64px",
                    "lg": "24px",
                    "base": "4px",
                    "gutter": "24px",
                    "container-max": "1280px"
            },
            "fontFamily": {
                    "headline-lg": ["Plus Jakarta Sans"],
                    "headline-lg-mobile": ["Plus Jakarta Sans"],
                    "headline-xl": ["Plus Jakarta Sans"],
                    "body-sm": ["Plus Jakarta Sans"],
                    "label-md": ["Plus Jakarta Sans"],
                    "body-md": ["Plus Jakarta Sans"],
                    "headline-md": ["Plus Jakarta Sans"],
                    "label-lg": ["Plus Jakarta Sans"],
                    "body-lg": ["Plus Jakarta Sans"]
            },
            "fontSize": {
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                    "headline-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.01em", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "label-lg": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md antialiased">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-gutter max-w-container-max mx-auto bg-white/80 dark:bg-surface/80 backdrop-blur-md border-b border-outline-variant/30 shadow-sm h-16">
<div class="flex items-center gap-xl">
<span class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed">UMKM Market</span>
<div class="hidden md:flex items-center gap-lg">
<a class="text-secondary font-bold border-b-2 border-secondary pb-1 font-label-lg text-label-lg" href="#">Marketplace</a>
<a class="text-on-surface-variant hover:text-primary transition-colors font-label-lg text-label-lg" href="#">Local Artisans</a>
<a class="text-on-surface-variant hover:text-primary transition-colors font-label-lg text-label-lg" href="#">Community</a>
</div>
</div>
<div class="flex items-center gap-md">
<div class="relative group cursor-pointer active:scale-95 text-on-surface-variant hover:bg-surface-container-low p-2 rounded-full transition-all duration-200">
<span class="material-symbols-outlined">shopping_cart</span>
</div>
<div class="relative group cursor-pointer active:scale-95 text-on-surface-variant hover:bg-surface-container-low p-2 rounded-full transition-all duration-200">
<span class="material-symbols-outlined">account_circle</span>
</div>
<button class="md:hidden text-on-surface-variant">
<span class="material-symbols-outlined">menu</span>
</button>
</div>
</nav>
<!-- Main Content Canvas -->
<main class="pt-16">
<!-- Hero Section with Glassmorphism -->
<section class="relative w-full min-h-[819px] flex items-center overflow-hidden">
<!-- Hero Background Animation/Image -->
<div class="absolute inset-0 z-0">
<div class="absolute inset-0 bg-gradient-to-tr from-primary/20 via-transparent to-secondary/10"></div>
<div class="w-full h-full bg-cover bg-center" data-alt="A cinematic, wide-angle shot of a bright, modern workshop where a local artisan is meticulously crafting handmade pottery. The room is filled with soft, natural morning light filtering through large industrial windows, highlighting the dust particles in the air. The aesthetic is clean and professional, featuring a palette of warm wood tones, navy blues, and modern blue accents. The mood is inspiring and community-focused, celebrating the fusion of traditional craftsmanship and contemporary commerce." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDL_Qm2awNVUs_L9hrnnEi_tK5xeSLmzJHZVotJRONyJ5xudHGLvcUbsu87ZB9RqiADIWl2vck3CDYPSlflTYfySo8HXTavmwNBpp65xwGDLh8Nw9kCIXxL7vu8vvXss6YsInN2P-Q5Ce0E-5Pm0cDcT5Yn-ugzCzBnDL8LgJrsPVF8fWuoaDrIcmVeWfF4j_zZTzo6HEmyzIWVx017uU0uLRaLlZAiIwHVEAwwZwbC_LHon6IOCFiV')"></div>
</div>
<div class="relative z-10 w-full max-w-container-max mx-auto px-gutter py-3xl">
<div class="max-w-2xl glass-panel p-xl rounded-xl border border-white/40 shadow-xl animate-fade-in-up">
<div class="inline-flex items-center px-sm py-1 rounded-full bg-secondary-container/20 text-secondary mb-md border border-secondary/20">
<span class="material-symbols-outlined text-[16px] mr-1" style="font-variation-settings: 'FILL' 1;">stars</span>
<span class="font-label-md text-label-md">Verified Local Artisans</span>
</div>
<h1 class="font-headline-xl text-headline-xl md:text-headline-xl text-primary mb-md leading-tight">
                        Empowering Local Crafts, <br/><span class="text-secondary">Connecting Communities.</span>
</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-xl max-w-lg">
                        Discover unique, high-quality products directly from Indonesia's finest small businesses. Experience craftsmanship that tells a story.
                    </p>
<div class="flex flex-wrap gap-md">
<button class="bg-primary text-on-primary font-label-lg text-label-lg px-xl py-4 rounded-lg flex items-center gap-sm shadow-lg hover:bg-primary-container transition-all active:scale-95">
                            Belanja Sekarang
                            <span class="material-symbols-outlined">arrow_forward</span>
</button>
<button class="bg-white/50 border border-outline-variant text-primary font-label-lg text-label-lg px-xl py-4 rounded-lg hover:bg-white/80 transition-all active:scale-95">
                            Join as Seller
                        </button>
</div>
</div>
</div>
</section>
<!-- Stats Section -->
<section class="bg-white py-xl border-y border-outline-variant/30">
<div class="max-w-container-max mx-auto px-gutter grid grid-cols-2 md:grid-cols-4 gap-lg">
<div class="text-center">
<p class="font-headline-md text-headline-md text-primary">5,000+</p>
<p class="font-label-md text-label-md text-on-surface-variant">Active Artisans</p>
</div>
<div class="text-center border-l border-outline-variant/30">
<p class="font-headline-md text-headline-md text-primary">120k+</p>
<p class="font-label-md text-label-md text-on-surface-variant">Products Sold</p>
</div>
<div class="text-center border-l border-outline-variant/30">
<p class="font-headline-md text-headline-md text-primary">34</p>
<p class="font-label-md text-label-md text-on-surface-variant">Provinces Covered</p>
</div>
<div class="text-center border-l border-outline-variant/30">
<p class="font-headline-md text-headline-md text-primary">4.9/5</p>
<p class="font-label-md text-label-md text-on-surface-variant">Seller Rating</p>
</div>
</div>
</section>
<!-- Featured Products Section -->
<section class="py-3xl max-w-container-max mx-auto px-gutter">
<div class="flex justify-between items-end mb-2xl">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary">Featured Marketplace Items</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Curated selections from our top-rated local craftsmen.</p>
</div>
<button class="text-secondary font-label-lg text-label-lg flex items-center gap-xs group">
                    View All Products
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">chevron_right</span>
</button>
</div>
<!-- Bento-style Grid -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-lg h-auto">
<!-- Large Feature Card -->
<div class="md:col-span-8 group bg-white border border-outline-variant/50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
<div class="relative h-96 overflow-hidden">
<div class="absolute top-4 left-4 z-10 bg-emerald-500/10 text-emerald-700 px-3 py-1 rounded-full font-label-md text-label-md border border-emerald-500/20 backdrop-blur-sm">Verified Local</div>
<div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110" data-alt="A stunning overhead flat-lay of handcrafted Indonesian batik textiles in deep indigo and cream patterns, arranged artfully with natural wooden weaving tools. The lighting is soft and diffused, creating a premium and authentic mood. The color palette emphasizes rich navy and modern blue tones, suggesting a blend of tradition and modern high-end retail. The image looks professional and editorial." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAO_E0UiN471lja0uQ0wPvNNo2Ds0_76ydaaHnUEZ_niI6WX-otziv2eDUAdcAgXnVOxY4aOoxl5MjCizitCioOYQpVqcfXdnZ0Fnl2hDhQjrjJ2kYlMqhRNMhYW0AiFus249jX_vpbD-C1FFvfHWv7UlFn9E8z-D-L9IcEGpC8T1rEwRMzXpkY8RqW_lQS7nAkxSXUgyhcrVB1cYkWaFWE1oF2gQOoe-99kD8zmNDusXEonkgtgxh9')"></div>
</div>
<div class="p-lg flex justify-between items-center">
<div>
<h3 class="font-headline-md text-headline-md text-primary">Traditional Hand-Drawn Batik Collection</h3>
<p class="font-body-md text-body-md text-on-surface-variant">Pekalongan Heritage Series</p>
</div>
<div class="text-right">
<p class="font-headline-sm text-headline-sm text-secondary font-bold">Rp 850.000</p>
<button class="mt-sm text-primary font-label-lg text-label-lg flex items-center gap-xs">
<span class="material-symbols-outlined">add_shopping_cart</span>
                                Add to Cart
                            </button>
</div>
</div>
</div>
<!-- Vertical Cards -->
<div class="md:col-span-4 flex flex-col gap-lg">
<!-- Product 2 -->
<div class="group bg-white border border-outline-variant/50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all flex-1">
<div class="relative h-48 overflow-hidden">
<div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="A minimalist studio product shot of a hand-carved teak wood serving tray set against a clean, neutral background. The wood grain is prominent and elegant, illuminated by a soft side-light that creates gentle shadows. The style is modern and high-end, fitting for a premium marketplace. Subtle navy accents are integrated through the styling elements." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDsHluGHA6hH16dQm35puXelTaA1iUNtDe22AqEqKwExWv66-jiTKMHZ_DQCRYl-EGb-uYSv0Tgrv70AUfAwX2MUwIqWVDw2xfqXHMrSZ6ronp5A_UCySgDktleWCusJKAEcnbXPIcGJh1VFytx3AjOMyWObhZAcYoXptfcDWnQlsP1CJOQ8JUB0uiyI8Vou0KjsO81iCVlIS4K9fJ9qbqmF86RCAQYzQK3TivViJaml7uhSYnv50In')"></div>
</div>
<div class="p-md">
<div class="flex justify-between items-start mb-xs">
<h3 class="font-label-lg text-label-lg text-primary">Teak Wood Tray Set</h3>
<span class="font-label-md text-label-md text-secondary font-bold">Rp 320k</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">Sustainably sourced Java teak wood, hand-finished by master carvers.</p>
</div>
</div>
<!-- Product 3 -->
<div class="group bg-white border border-outline-variant/50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all flex-1">
<div class="relative h-48 overflow-hidden">
<div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="Close-up of organic, artisanal coffee beans in a woven bamboo basket, with a rustic ceramic mug nearby. The scene is lit with warm, moody lighting that highlights the texture of the beans and the craft of the basket. The colors are rich browns, earthy tones, and deep blues. A clean, professional marketplace aesthetic that emphasizes quality and origin." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD4STU-5GyPs5PLnOwjAfNQSjqSpE6wDvxpGyAuQl40e8-Tq9_05_cH6Eto0r4Ipfyku5aVa90tG60HFQ2O6dV3BdH1auwkjG3wstS1a2rRt93pDng4VOBcJLrx4iIz5yjeoY5yNtx7Dk_A0k4J2TDF0JutChfw6m3tH85UWUJoMHDZ_3ABF4AmnFdUSXpyLSba4oDWD7lThipp6TOG_KtQuPL8682UIb0DM4dDipMnk8F8w5brRdLP')"></div>
</div>
<div class="p-md">
<div class="flex justify-between items-start mb-xs">
<h3 class="font-label-lg text-label-lg text-primary">Organic Gayo Coffee</h3>
<span class="font-label-md text-label-md text-secondary font-bold">Rp 125k</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">Single-origin highland arabica, freshly roasted in small batches.</p>
</div>
</div>
</div>
</div>
<!-- More Grid Items -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-lg mt-lg">
<!-- Repeatable card structure -->
<div class="group bg-white border border-outline-variant/50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
<div class="h-48 bg-cover bg-center" data-alt="Handcrafted leather wallet shown in high-detail macro shot, emphasizing the stitching quality and the rich texture of the brown leather. Professional studio lighting with a soft gradient background in navy tones. Minimalist and dependable vibe." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMzzys45Fw3EDyenAaf2x5FigbLm5ZYkn-r1aayLlYXuuzk0C8n2cNPptbPIm4oA9pXlUIgGohFcDFq_mBlkGaHZSd1Uvt1CuTwDQ8iLq5LE2PMagUKU1q8_oYIlvNTNzYduKCAtOkpz4q44Ie2JRZqi0fyK6xAWRxhQ9Ue9lCotU6j9KTNyf9GERiCNtZ9PBeb1Tf7_DR1XcrMqDVM1HfUJN5xSmZCJDDShMx55j4DZt66mkHJE9m')"></div>
<div class="p-md">
<h4 class="font-label-lg text-label-lg text-primary">Leather Wallet</h4>
<p class="text-secondary font-bold font-label-md text-label-md mt-1">Rp 450.000</p>
</div>
</div>
<div class="group bg-white border border-outline-variant/50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
<div class="h-48 bg-cover bg-center" data-alt="Artisanal woven rattan bag held by a model in a sunlit outdoor setting. Modern boho-chic aesthetic, bright and airy light-mode feel. Clear, crisp photography with a focus on local craftsmanship and modern fashion." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBqIR-Hx9mYIFvu27VpoWYwUd4BEn1ignGmZQX7igDLoCChvO4aoZ-yjP8IO0y-vWWJEzC9kdlNtTYP_vRndLDffsjuP_p_6GUipfvccRXvY-zohZB4ki5OqxskuGluKpg4nQi9O4QF-mFaZTj-Zgaac86njDxRlRUkVUqOYPbLSr0IbHwpNnzz8t6UNKWEGmLVvYPD5XowlFK5mHelkVRpTw3hpYRxVz1pup65Zaa51CE2A9fIP8Bk')"></div>
<div class="p-md">
<h4 class="font-label-lg text-label-lg text-primary">Lombok Woven Bag</h4>
<p class="text-secondary font-bold font-label-md text-label-md mt-1">Rp 275.000</p>
</div>
</div>
<div class="group bg-white border border-outline-variant/50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
<div class="h-48 bg-cover bg-center" data-alt="Handmade natural soap bars stacked elegantly with dried lavender and eucalyptus. Soft, clean lighting and a minimalist white aesthetic. The image conveys purity, quality, and organic origins in a professional commercial style." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuANb5umSKHhsEhT5gPKVpne8wEENbuj8QT7Ch6yFlQZmx8yVagLyT8o4vH6KHR-yxRRtIzHAIO8yqhwhHP3Q2xpCLtrmkQ3m2HzTiSUKVMMsNHFIsu_JsQkN2iJeBuOhLygaj1Yv8UsSB9FXPv3UugTCpZTBOdxigic6V6p0LmTZJcqD3py2XrdA-FQvVBuECtlpPuFd1SJUzIrUwk3ZkaKG73Q47C2EgbK9sSQAgmx3OJOYd8ge-oQ')"></div>
<div class="p-md">
<h4 class="font-label-lg text-label-lg text-primary">Organic Soap Set</h4>
<p class="text-secondary font-bold font-label-md text-label-md mt-1">Rp 95.000</p>
</div>
</div>
<div class="group bg-white border border-outline-variant/50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
<div class="h-48 bg-cover bg-center" data-alt="A set of ceramic bowls with unique blue glazes, handcrafted by a local potter. Displayed on a rustic wooden table with a soft focus background. Professional product photography that emphasizes texture, color, and artisanal value." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAXGf0JIVqwbVXrhjtMD1LDR8dmp7tVtQvyxbEopEBD6KPNlg4jLF2zlL3jEtbYttpkulTfJs_EVrwzhyYHm6fdP1dN7D6uqFXwKuiLmuvi-uBPhHzvAkahLfbaTmSuhn9O2lL3KvBnl592QA9CA1drEtvJSMQiEYT318hhtZszlSTdOWQcoCbrJLrS6MJlEtC2F7h8GLUaUDMbBJhWJBDIotlLWNv2_eLpmImNHYQLUlBi2R3xbFCK')"></div>
<div class="p-md">
<h4 class="font-label-lg text-label-lg text-primary">Ceramic Bowl Set</h4>
<p class="text-secondary font-bold font-label-md text-label-md mt-1">Rp 580.000</p>
</div>
</div>
</div>
</section>
<!-- Artisans Spotlight Section -->
<section class="bg-surface-container-low py-3xl">
<div class="max-w-container-max mx-auto px-gutter">
<div class="grid grid-cols-1 md:grid-cols-2 gap-3xl items-center">
<div class="relative">
<div class="absolute -top-10 -left-10 w-40 h-40 bg-secondary/10 rounded-full blur-3xl"></div>
<div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
<img class="w-full h-auto aspect-square object-cover" data-alt="A portrait of a smiling Indonesian woman in her late 40s, standing proudly in her craft studio surrounded by beautiful hand-woven textiles. The lighting is warm and genuine, capturing an authentic moment of community and pride. The setting is organized yet full of life, representing the dependable and professional nature of the UMKM market. Navy and modern blue colors are present in her attire and studio accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyWY1oUe2M34M1z2k2UddRG4Acs0QoOnd5Wmdp17Gk5f50P1VVPk6ZIOrNe8Tu9Z2HBhkrWbHWHRUlkavVUvwc0PHXjnakE0YMJPiWHTyFCLcIw1L_zuOok05_gs8Z_Qi6b4b13dfiudg4m_8GRg5Guj_vCb3dE7M5mwCYAWVEkYrBjpK-k1ghlI_o82zSV2i-H9TRPe5fCo_pQ3n7M22E12KlgstKKHdZoChu8iQlPzCefldCNYeh"/>
</div>
<div class="absolute -bottom-6 -right-6 glass-panel p-md rounded-xl border border-white/50 shadow-lg max-w-[240px]">
<p class="font-label-lg text-label-lg text-primary">"UMKM Market helped me reach customers I never thought possible."</p>
<p class="font-label-md text-label-md text-on-surface-variant mt-sm">— Ibu Sarah, Weaver from Bali</p>
</div>
</div>
<div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-md">Meet the Makers Behind the Craft</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-xl">
                            We go beyond transactions. Every product on our platform is vetted for quality and authenticity, ensuring you get the real Indonesian experience while directly supporting the families who create them.
                        </p>
<div class="space-y-lg">
<div class="flex gap-md">
<div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary">verified_user</span>
</div>
<div>
<h4 class="font-label-lg text-label-lg text-primary">Direct-from-Source</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Eliminating middlemen to ensure fair pricing for both you and the artisan.</p>
</div>
</div>
<div class="flex gap-md">
<div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary">location_on</span>
</div>
<div>
<h4 class="font-label-lg text-label-lg text-primary">Cultural Preservation</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Helping traditional techniques thrive in the modern digital age.</p>
</div>
</div>
</div>
<button class="mt-2xl text-secondary font-bold font-label-lg text-label-lg flex items-center gap-sm group">
                            Explore Artisan Stories
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</button>
</div>
</div>
</div>
</section>
<!-- Newsletter CTA -->
<section class="py-3xl max-w-container-max mx-auto px-gutter text-center">
<div class="bg-primary rounded-3xl p-3xl text-on-primary relative overflow-hidden">
<div class="absolute top-0 right-0 w-64 h-64 bg-secondary/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
<div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/20 rounded-full blur-3xl -ml-32 -mb-32"></div>
<div class="relative z-10 max-w-xl mx-auto">
<h2 class="font-headline-lg text-headline-lg mb-md">Never Miss a Unique Piece</h2>
<p class="font-body-md text-body-md opacity-90 mb-xl">Subscribe to our newsletter for exclusive artisan stories, new product drops, and community events.</p>
<form class="flex flex-col sm:flex-row gap-md" onsubmit="event.preventDefault()">
<input class="flex-1 bg-white/10 border border-white/20 rounded-lg px-lg py-3 text-on-primary placeholder:text-white/50 focus:outline-none focus:ring-2 focus:ring-secondary" placeholder="Enter your email address" type="email"/>
<button class="bg-secondary text-on-secondary font-label-lg text-label-lg px-xl py-3 rounded-lg shadow-lg hover:bg-secondary-container transition-all active:scale-95">
                            Subscribe Now
                        </button>
</form>
<p class="font-label-md text-label-md mt-md opacity-70">By subscribing, you agree to our Privacy Policy.</p>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full py-xl px-gutter grid grid-cols-1 md:grid-cols-3 gap-lg max-w-container-max mx-auto bg-surface-container-highest dark:bg-inverse-surface border-t border-outline-variant">
<div class="flex flex-col gap-md">
<span class="font-headline-sm text-headline-sm text-primary dark:text-primary-fixed-dim">UMKM Market</span>
<p class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline max-w-xs">Connecting the heart of local craftsmanship with the modern digital shopper. Dependable, authentic, and Indonesian.</p>
<div class="flex gap-md mt-sm">
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-secondary">public</span>
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-secondary">share</span>
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-secondary">alternate_email</span>
</div>
</div>
<div class="grid grid-cols-2 gap-lg">
<div class="flex flex-col gap-sm">
<span class="font-label-lg text-label-lg text-on-surface font-bold">Marketplace</span>
<a class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline hover:text-secondary transition-colors" href="#">Categories</a>
<a class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline hover:text-secondary transition-colors" href="#">Featured Artisans</a>
<a class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline hover:text-secondary transition-colors" href="#">New Arrivals</a>
</div>
<div class="flex flex-col gap-sm">
<span class="font-label-lg text-label-lg text-on-surface font-bold">Company</span>
<a class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline hover:text-secondary transition-colors" href="#">About</a>
<a class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline hover:text-secondary transition-colors" href="#">Contact Us</a>
<a class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline hover:text-secondary transition-colors" href="#">Privacy Policy</a>
</div>
</div>
<div class="flex flex-col justify-between items-start md:items-end">
<div class="flex flex-col md:items-end gap-xs">
<span class="font-label-md text-label-md text-on-surface-variant dark:text-outline">Ready to start selling?</span>
<button class="bg-primary text-on-primary px-lg py-2 rounded-lg font-label-lg text-label-lg shadow-sm hover:bg-primary-container transition-all">Visit Seller Hub</button>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline mt-xl md:mt-0">© 2024 UMKM Marketplace. Supporting local artisans.</p>
</div>
</footer>
<script>
        // Micro-interactions and animations
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, observerOptions);

            // Add animation classes to sections
            document.querySelectorAll('section').forEach(section => {
                section.classList.add('transition-all', 'duration-700', 'ease-out', 'opacity-0', 'translate-y-10');
                observer.observe(section);
            });
        });

        // Simple sticky nav highlight
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 20) {
                nav.classList.add('py-2', 'shadow-md');
                nav.classList.remove('h-16');
            } else {
                nav.classList.remove('py-2', 'shadow-md');
                nav.classList.add('h-16');
            }
        });
    </script>
</body></html>