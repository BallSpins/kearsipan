<!DOCTYPE html>
<html lang="en" class="scroll-smooth" style="scroll-behavior: smooth"> 
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHTEN | Digital Archiving System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
    </style>
  </head>
<body class="bg-[#F8FAFC] text-[#061E29] overflow-x-hidden">

    <header class="fixed w-full z-50 bg-white/90 backdrop-blur-lg border-b border-gray-100">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-extrabold tracking-tighter uppercase">ARCHTEN.</div>
            <div class="hidden md:flex gap-10 font-bold text-[10px] uppercase tracking-[0.2em]">
                <a href="#features" class="hover:text-[#28A745] transition">Features</a>
                <a href="#workflow" class="hover:text-[#28A745] transition">Workflow</a>
                <a href="#about" class="hover:text-[#28A745] transition">About</a>
            </div>
            <a href="{{ route('login.view') }}" class="bg-[#061E29] text-white px-8 py-2 rounded-sm font-bold hover:bg-[#28A745] transition uppercase text-[10px] tracking-widest">
                Login System
            </a>
        </nav>
    </header>

    <section id="hero" class="pt-40 pb-20 px-6 bg-[#061E29] text-white min-h-screen flex items-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-[#28A745]/5 skew-x-12 translate-x-20"></div>
        <div class="container mx-auto grid md:grid-cols-2 gap-16 items-center relative z-10">
            <div>
                <span class="text-[#28A745] font-bold tracking-[0.3em] uppercase text-xs mb-6 block">The New Standard</span>
                <h1 class="text-6xl md:text-8xl font-extrabold leading-[0.9] mb-8 uppercase">
                    Efisien. <br> Terarah. <br> <span class="text-[#28A745]">Permanen.</span>
                </h1>
                <p class="text-gray-400 text-lg mb-12 max-w-md leading-relaxed">
                    Sistem pengarsipan digital yang mengunci integritas data Anda. Menghilangkan kerumitan birokrasi fisik dengan satu klik presisi.
                </p>
                <div class="flex gap-6">
                    <a href="#features" class="bg-[#28A745] text-white px-10 py-5 font-bold uppercase tracking-widest hover:bg-white hover:text-[#061E29] transition duration-300">
                        Jelajahi Fitur
                    </a>
                </div>
            </div>
            <div class="relative ml-56">
                <div class="aspect-[4/5] bg-gray-800 border border-gray-700 shadow-2xl overflow-hidden transition duration-700">
                    <img src="{{ asset('lobby.jpg') }}" alt="Archten Preview" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-32 px-6 container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8">
            <div class="max-w-2xl">
                <h2 class="text-5xl font-extrabold uppercase tracking-tighter mb-6">Keunggulan <br>Inti Sistem.</h2>
                <p class="text-gray-500 text-lg leading-relaxed">Kami tidak hanya memindahkan kertas ke layar. Kami membangun infrastruktur kearsipan yang menjamin keamanan dan kecepatan.</p>
            </div>
            <div class="text-[#28A745] font-black text-8xl opacity-10 hidden md:block italic">FEATURES</div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-1px bg-gray-200 border border-gray-200">
            <div class="bg-white p-12 hover:bg-gray-50 transition-all duration-300">
                <div class="w-12 h-12 bg-[#061E29] text-white flex items-center justify-center mb-10">01</div>
                <h4 class="text-xl font-bold mb-4 uppercase">Auto Numbering</h4>
                <p class="text-gray-500 text-sm leading-relaxed font-medium">Penomoran otomatis berbasis klasifikasi yang mencegah terjadinya nomor ganda secara absolut.</p>
            </div>
            <div class="bg-white p-12 hover:bg-gray-50 transition-all duration-300">
                <div class="w-12 h-12 bg-[#061E29] text-white flex items-center justify-center mb-10">02</div>
                <h4 class="text-xl font-bold mb-4 uppercase">Double Approval</h4>
                <p class="text-gray-500 text-sm leading-relaxed font-medium">Mekanisme validasi bertingkat untuk memastikan setiap surat keluar telah disetujui pimpinan.</p>
            </div>
            <div class="bg-white p-12 hover:bg-gray-50 transition-all duration-300">
                <div class="w-12 h-12 bg-[#061E29] text-white flex items-center justify-center mb-10">03</div>
                <h4 class="text-xl font-bold mb-4 uppercase">Atomic Sync</h4>
                <p class="text-gray-500 text-sm leading-relaxed font-medium">Data Anda tersimpan secara utuh atau tidak sama sekali, menjamin tidak ada arsip yang rusak di tengah proses.</p>
            </div>
            <div class="bg-white p-12 hover:bg-gray-50 transition-all duration-300">
                <div class="w-12 h-12 bg-[#061E29] text-white flex items-center justify-center mb-10">04</div>
                <h4 class="text-xl font-bold mb-4 uppercase">Role Security</h4>
                <p class="text-gray-500 text-sm leading-relaxed font-medium">Pembatasan hak akses yang ketat sesuai jabatan. Privasi dokumen adalah prioritas utama kami.</p>
            </div>
        </div>
    </section>

    <section id="workflow" class="py-32 bg-[#061E29] text-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold uppercase mb-20 text-center tracking-widest">Digital Workflow</h2>
            <div class="grid md:grid-cols-3 gap-16 relative">
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-px bg-gray-800 z-0"></div>
                
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 bg-[#28A745] rounded-full mx-auto flex items-center justify-center mb-8 shadow-[0_0_30px_rgba(40,167,69,0.3)]">
                        <span class="text-2xl font-black">1</span>
                    </div>
                    <h5 class="text-xl font-bold mb-4 uppercase">Request & Input</h5>
                    <p class="text-gray-400 text-sm">Pengajuan surat masuk atau draft surat keluar diinput ke sistem.</p>
                </div>
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 bg-[#28A745] rounded-full mx-auto flex items-center justify-center mb-8 shadow-[0_0_30px_rgba(40,167,69,0.3)]">
                        <span class="text-2xl font-black">2</span>
                    </div>
                    <h5 class="text-xl font-bold mb-4 uppercase">Validation</h5>
                    <p class="text-gray-400 text-sm">Pimpinan melakukan review dan approval secara digital.</p>
                </div>
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 bg-[#28A745] rounded-full mx-auto flex items-center justify-center mb-8 shadow-[0_0_30px_rgba(40,167,69,0.3)]">
                        <span class="text-2xl font-black">3</span>
                    </div>
                    <h5 class="text-xl font-bold mb-4 uppercase">Automatic Archive</h5>
                    <p class="text-gray-400 text-sm">Nomor diterbitkan otomatis dan dokumen tersimpan permanen di database.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-32 px-6 container mx-auto">
        <div class="grid md:grid-cols-2 gap-20 items-center">
            <div class="bg-gray-200 aspect-square overflow-hidden border-8 border-white shadow-xl">
                <img src="{{ asset('clean-workspace.jpg') }}" alt="About Team" class="w-full h-full object-cover">
            </div>
            <div>
                <h2 class="text-5xl font-extrabold uppercase mb-8 leading-tight">Membangun Masa Depan <span class="text-[#28A745]">Tanpa Kertas.</span></h2>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    ARCHTEN lahir dari kebutuhan mendesak akan sistem manajemen dokumen yang tangguh di lingkungan pendidikan. Kami menggabungkan prinsip rekayasa perangkat lunak modern dengan kebutuhan praktis administrasi sekolah.
                </p>
                <p class="text-gray-600 mb-10 leading-relaxed">
                    Dikembangkan dengan fokus pada <strong>Integritas Data</strong> dan <strong>Keamanan</strong>, ARCHTEN adalah wujud dari komitmen kami untuk efisiensi birokrasi di SMK Negeri 10 Surabaya.
                </p>
                <div class="border-l-4 border-[#28A745] pl-6 italic text-gray-400 text-sm">
                    "Teknologi tidak hanya mempermudah, ia harus memastikan kebenaran data tetap terjaga selamanya."
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 py-20 px-6">
        <div class="container mx-auto grid md:grid-cols-3 gap-16 mb-16">
            <div>
                <h3 class="text-2xl font-black mb-6">ARCHTEN.</h3>
                <p class="text-gray-400 text-sm">Solusi Kearsipan Digital Berbasis Rekayasa Perangkat Lunak.</p>
            </div>
            <div>
                <h4 class="font-bold uppercase text-[10px] tracking-widest text-gray-400 mb-6">Navigasi</h4>
                <ul class="space-y-4 font-bold text-xs uppercase tracking-wider">
                    <li><a href="#hero" class="hover:text-[#28A745]">Home</a></li>
                    <li><a href="#features" class="hover:text-[#28A745]">Features</a></li>
                    <li><a href="#workflow" class="hover:text-[#28A745]">Workflow</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold uppercase text-[10px] tracking-widest text-gray-400 mb-6">Support</h4>
                <p class="text-sm font-bold mb-2">SMK Negeri 10 Surabaya</p>
                <p class="text-gray-400 text-xs">Helpdesk: support@archten.io</p>
            </div>
        </div>
        <div class="container mx-auto pt-8 border-t border-gray-50 text-[10px] font-bold uppercase tracking-[0.4em] text-gray-300 text-center">
            &copy; 2026 ARCHTEN System - All Rights Reserved
        </div>
    </footer>

</body>
</html>