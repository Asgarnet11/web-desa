<!-- Floating Virtual Civic Assistant Widget: Sapa Sukawarna -->
<div id="sapa-sukawarna-root" class="fixed bottom-6 right-6 z-40 select-none print:hidden">
    <!-- Trigger Floating Bubble Button -->
    <button type="button" 
            id="sapa-trigger-btn"
            class="group flex items-center gap-2.5 px-4 py-3 rounded-full bg-[#1B4332] text-white shadow-2xl hover:bg-[#2D6A4F] hover:scale-105 active:scale-95 transition-all duration-300 border-2 border-[#FFB703]/50">
        <div class="relative w-7 h-7 rounded-full bg-[#FFB703] text-[#1B4332] flex items-center justify-center font-bold text-sm shadow-inner flex-shrink-0">
            <span>🤖</span>
            <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-400 border-2 border-[#1B4332] animate-pulse"></span>
        </div>
        <div class="text-left hidden sm:block">
            <span class="block text-[10px] text-[#FFB703] font-bold uppercase tracking-wider leading-none">Asisten Digital</span>
            <span class="block text-xs font-black tracking-tight leading-tight">Sapa Sukawarna</span>
        </div>
        <span class="sm:hidden text-xs font-bold text-[#FFB703]">Tanya AI</span>
    </button>

    <!-- Chat Window Container (Initially Hidden) -->
    <div id="sapa-chat-window" 
         class="hidden absolute bottom-16 right-0 w-[92vw] sm:w-[390px] h-[540px] max-h-[80vh] bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 animate-in fade-in slide-in-from-bottom-4">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-[#1B4332] to-[#2D6A4F] p-4 text-white flex items-center justify-between border-b border-[#FFB703]/30">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-[#FFB703] text-[#1B4332] flex items-center justify-center text-xl shadow-md border border-white/20">
                    🤖
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <h4 class="font-serif font-black text-sm text-white">Sapa Sukawarna</h4>
                        <span class="px-1.5 py-0.2 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[9px] font-bold">Online</span>
                    </div>
                    <p class="text-[10px] text-white/80">Panduan Resmi Layanan Warga 24/7</p>
                </div>
            </div>
            <button type="button" 
                    id="sapa-close-btn" 
                    class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white/80 hover:text-white flex items-center justify-center text-lg leading-none transition-colors"
                    title="Tutup Chat">
                &times;
            </button>
        </div>

        <!-- Quick Topic Chips -->
        <div class="p-2.5 bg-slate-50 border-b border-gray-100 flex items-center gap-1.5 overflow-x-auto scrollbar-none text-[11px]">
            <button type="button" class="sapa-quick-chip px-2.5 py-1 rounded-full bg-white border border-gray-200 text-gray-700 hover:border-[#1B4332] hover:text-[#1B4332] font-semibold whitespace-nowrap transition-colors" data-prompt="Syarat bikin KTP dan Kartu Keluarga">
                📋 Syarat KTP/KK
            </button>
            <button type="button" class="sapa-quick-chip px-2.5 py-1 rounded-full bg-white border border-gray-200 text-gray-700 hover:border-[#1B4332] hover:text-[#1B4332] font-semibold whitespace-nowrap transition-colors" data-prompt="Jam berapa loket pelayanan buka?">
                ⏰ Jam Pelayanan
            </button>
            <button type="button" class="sapa-quick-chip px-2.5 py-1 rounded-full bg-white border border-gray-200 text-gray-700 hover:border-[#1B4332] hover:text-[#1B4332] font-semibold whitespace-nowrap transition-colors" data-prompt="Bagaimana cara lapor pengaduan jalan rusak?">
                🚨 Cara Pengaduan
            </button>
            <button type="button" class="sapa-quick-chip px-2.5 py-1 rounded-full bg-white border border-gray-200 text-gray-700 hover:border-[#1B4332] hover:text-[#1B4332] font-semibold whitespace-nowrap transition-colors" data-prompt="Nomor telepon darurat kelurahan">
                📞 Kontak Darurat
            </button>
        </div>

        <!-- Messages Body -->
        <div id="sapa-messages-container" class="flex-1 p-4 overflow-y-auto space-y-3 text-xs bg-[#FFF8E7]/20">
            <!-- Bot Welcome Bubble -->
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-full bg-[#FFB703] text-[#1B4332] flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                    🤖
                </div>
                <div class="bg-white rounded-2xl rounded-tl-xs p-3.5 shadow-xs border border-gray-100 text-gray-800 leading-relaxed max-w-[85%] space-y-1.5">
                    <p><strong class="text-[#1B4332]">Sampurasun! Halo Wargi Sukawarna! 🙏</strong></p>
                    <p>Saya <strong>Sapa Sukawarna</strong>, asisten pintar layanan kelurahan. Ada yang bisa saya bantu seputar pengurusan surat, cek tiket pengaduan, atau fasilitas wilayah?</p>
                    <div class="pt-1 text-[10px] text-gray-400">Silakan ketik pertanyaan Anda di bawah atau pilih topik cepat di atas.</div>
                </div>
            </div>
        </div>

        <!-- Typing Indicator (Hidden by default) -->
        <div id="sapa-typing" class="hidden px-4 py-2 bg-[#FFF8E7]/20 text-[11px] text-gray-500 italic flex items-center gap-2">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-600 animate-bounce"></span>
            <span>Sapa Sukawarna sedang mengetik...</span>
        </div>

        <!-- Input Bar -->
        <form id="sapa-chat-form" class="p-3 bg-white border-t border-gray-100 flex items-center gap-2">
            <input type="text" 
                   id="sapa-user-input"
                   placeholder="Tanyakan sesuatu (cth: syarat surat nikah)..." 
                   class="flex-1 px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-[#2D6A4F] focus:ring-1 focus:ring-[#2D6A4F] text-xs outline-none bg-gray-50/50">
            <button type="submit" 
                    class="p-2.5 rounded-xl bg-[#1B4332] hover:bg-[#2D6A4F] text-[#FFB703] font-bold shadow-xs transition-colors flex-shrink-0"
                    title="Kirim Pertanyaan">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const triggerBtn = document.getElementById('sapa-trigger-btn');
    const closeBtn = document.getElementById('sapa-close-btn');
    const chatWindow = document.getElementById('sapa-chat-window');
    const chatForm = document.getElementById('sapa-chat-form');
    const userInput = document.getElementById('sapa-user-input');
    const messagesContainer = document.getElementById('sapa-messages-container');
    const typingIndicator = document.getElementById('sapa-typing');
    const quickChips = document.querySelectorAll('.sapa-quick-chip');

    if (!triggerBtn || !chatWindow) return;

    triggerBtn.addEventListener('click', () => {
        chatWindow.classList.toggle('hidden');
        if (!chatWindow.classList.contains('hidden')) {
            userInput.focus();
        }
    });

    closeBtn.addEventListener('click', () => {
        chatWindow.classList.add('hidden');
    });

    quickChips.forEach(chip => {
        chip.addEventListener('click', () => {
            const prompt = chip.dataset.prompt;
            sendUserMessage(prompt);
        });
    });

    chatForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const text = userInput.value.trim();
        if (!text) return;
        sendUserMessage(text);
        userInput.value = '';
    });

    function appendMessage(sender, htmlContent) {
        const row = document.createElement('div');
        row.className = sender === 'user' ? 'flex items-start justify-end gap-2' : 'flex items-start gap-2.5';

        if (sender === 'user') {
            row.innerHTML = `
                <div class="bg-[#1B4332] text-white rounded-2xl rounded-tr-xs p-3 shadow-xs text-xs max-w-[85%] leading-relaxed">
                    ${escapeHtml(htmlContent)}
                </div>
            `;
        } else {
            row.innerHTML = `
                <div class="w-7 h-7 rounded-full bg-[#FFB703] text-[#1B4332] flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                    🤖
                </div>
                <div class="bg-white rounded-2xl rounded-tl-xs p-3.5 shadow-xs border border-gray-100 text-gray-800 text-xs leading-relaxed max-w-[85%] space-y-1">
                    ${htmlContent}
                </div>
            `;
        }

        messagesContainer.appendChild(row);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function sendUserMessage(text) {
        appendMessage('user', text);
        typingIndicator.classList.remove('hidden');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        setTimeout(() => {
            typingIndicator.classList.add('hidden');
            const reply = generateBotResponse(text);
            appendMessage('bot', reply);
        }, 700);
    }

    // Knowledge-Grounded Civic NLP Rule Engine
    function generateBotResponse(input) {
        const q = input.toLowerCase();

        // 1. KTP / KK / Surat Kependudukan
        if (q.includes('ktp') || q.includes('kartu keluarga') || q.includes('kk') || q.includes('domisili')) {
            return `
                <p><strong class="text-[#1B4332]">Persyaratan Surat Kependudukan & Domisili:</strong></p>
                <ul class="list-disc list-inside space-y-1 text-gray-600 mt-1">
                    <li>Fotokopi KTP Pemohon (e-KTP)</li>
                    <li>Fotokopi Kartu Keluarga (KK) terbaru</li>
                    <li>Surat Pengantar dari Ketua RT & RW setempat</li>
                </ul>
                <div class="mt-2 pt-2 border-t border-gray-100 flex items-center gap-2">
                    <a href="/layanan" class="text-xs font-bold text-[#0284C7] hover:underline">
                        Buka Katalog Layanan &rarr;
                    </a>
                </div>
            `;
        }

        // 2. Jam Layanan / Operasional Kantor
        if (q.includes('jam') || q.includes('buka') || q.includes('operasional') || q.includes('waktu pelayanan') || q.includes('tutup')) {
            return `
                <p><strong class="text-[#1B4332]">Jadwal Pelayanan Kantor Kelurahan Sukawarna:</strong></p>
                <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100 text-[11px] space-y-0.5 mt-1 text-gray-700">
                    <p>📅 <strong>Senin &ndash; Kamis:</strong> 08.00 &ndash; 15.30 WIB (Istirahat 12.00-13.00)</p>
                    <p>📅 <strong>Jumat:</strong> 08.00 &ndash; 14.30 WIB (Istirahat 11.30-13.00)</p>
                    <p class="text-rose-600 font-semibold">Sabtu, Minggu & Hari Libur Nasional: Tutup</p>
                </div>
                <p class="text-[11px] text-gray-500 mt-1">Alamat kantor: Jl. Sukawarna No. 12, Kec. Sukasari, Kota Bandung.</p>
            `;
        }

        // 3. Pengaduan / Jalan Rusak / Sampah
        if (q.includes('lapor') || q.includes('aduan') || q.includes('pengaduan') || q.includes('rusak') || q.includes('sampah') || q.includes('pju')) {
            return `
                <p><strong class="text-[#1B4332]">Kanal Pengaduan Warga Sukawarna:</strong></p>
                <p class="mt-1 text-gray-700">Wargi dapat menyampaikan keluhan infrastruktur, kebersihan, atau pelayanan langsung melalui form online dengan fitur <strong>Deteksi Lokasi GPS</strong>.</p>
                <div class="mt-2 flex items-center gap-2">
                    <a href="/pengaduan" class="px-2.5 py-1 rounded-lg bg-[#FFB703] text-[#1B4332] font-bold text-[11px] hover:bg-amber-400">
                        Isi Form Laporan
                    </a>
                    <a href="/pengaduan/cek" class="text-[11px] font-bold text-[#0284C7] hover:underline">
                        Lacak Tiket &rarr;
                    </a>
                </div>
            `;
        }

        // 4. Kontak Darurat / Bencana / Polisi / Bhabin
        if (q.includes('darurat') || q.includes('bencana') || q.includes('sos') || q.includes('polisi') || q.includes('bhabin') || q.includes('babinsa') || q.includes('kebakaran')) {
            return `
                <p><strong class="text-rose-700">🚨 Kontak Tanggap Darurat 24 Jam:</strong></p>
                <ul class="space-y-1 text-gray-700 mt-1 text-[11px]">
                    <li>• <strong>Call Center 112</strong> (Bebas Pulsa - Darurat Bandung)</li>
                    <li>• <strong>Bhabinkamtibmas:</strong> 0812-3456-7891</li>
                    <li>• <strong>Babinsa Sukawarna:</strong> 0812-3456-7892</li>
                    <li>• <strong>Puskesmas Sukasari:</strong> (022) 2013456</li>
                </ul>
                <div class="mt-2">
                    <button type="button" onclick="document.getElementById('sos-modal').classList.remove('hidden')" class="px-2.5 py-1 rounded-lg bg-rose-600 text-white font-bold text-[11px] hover:bg-rose-700">
                        Buka Daftar Kontak Lengkap
                    </button>
                </div>
            `;
        }

        // 5. Peta / Fasilitas / GIS
        if (q.includes('peta') || q.includes('fasilitas') || q.includes('lokasi') || q.includes('sekolah') || q.includes('masjid') || q.includes('puskesmas')) {
            return `
                <p><strong class="text-[#1B4332]">Sistem Informasi Geografis (Peta Digital):</strong></p>
                <p class="mt-1 text-gray-700">Kelurahan Sukawarna memiliki peta interaktif yang memetakan seluruh fasilitas pendidikan, kesehatan, peribadatan, dan batas wilayah RW secara akurat.</p>
                <div class="mt-2">
                    <a href="/peta" class="inline-flex items-center gap-1 text-xs font-bold text-[#0284C7] hover:underline">
                        Buka Peta Spasial Sukawarna &rarr;
                    </a>
                </div>
            `;
        }

        // 6. UMKM / Usaha / Kuliner
        if (q.includes('umkm') || q.includes('usaha') || q.includes('jual') || q.includes('kuliner') || q.includes('produk')) {
            return `
                <p><strong class="text-[#1B4332]">Direktori UMKM Binaan Warga:</strong></p>
                <p class="mt-1 text-gray-700">Wargi dapat menjelajahi aneka produk lokal binaan seperti Kopi Kebun, Anyaman Bambu, dan Hidroponik. Anda juga bisa mendaftarkan usaha Anda secara mandiri!</p>
                <div class="mt-2 flex items-center gap-2">
                    <a href="/umkm" class="text-xs font-bold text-orange-600 hover:underline">
                        Lihat Direktori UMKM &rarr;
                    </a>
                </div>
            `;
        }

        // 7. Salam Sunda / Sapaan Ramah
        if (q.includes('sampurasun') || q.includes('kumaha') || q.includes('nuhun') || q.includes('pagi') || q.includes('halo') || q.includes('siang')) {
            return `
                <p><strong>Rampes! 🙏 Wilujeng sumping wargi Sukawarna!</strong></p>
                <p class="mt-1 text-gray-700">Aya anu tiasa dibantos perkawis palayanan, fasilitas, atanapi program kelurahan dinten ieu?</p>
            `;
        }

        // Fallback default
        return `
            <p>Terima kasih atas pertanyaannya wargi. Pertanyaan Anda mengenai <em>"${escapeHtml(input)}"</em> dapat langsung dikonsultasikan dengan petugas kami melalui WhatsApp atau menu terkait:</p>
            <div class="mt-2 pt-2 border-t border-gray-100 flex flex-wrap gap-2 text-[11px]">
                <a href="/layanan" class="px-2 py-1 rounded bg-sky-50 text-sky-700 font-bold hover:bg-sky-100">Layanan Warga</a>
                <a href="/pengaduan" class="px-2 py-1 rounded bg-amber-50 text-amber-700 font-bold hover:bg-amber-100">Kanal Lapor</a>
                <a href="https://wa.me/628122012345" target="_blank" class="px-2 py-1 rounded bg-emerald-50 text-emerald-700 font-bold hover:bg-emerald-100">Chat WhatsApp Loket</a>
            </div>
        `;
    }
});
</script>
