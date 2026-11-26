<x-layouts.app :title="'Layanan Administrasi - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 space-y-12">
        <!-- Page Header -->
        <div class="space-y-2">
            <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider block">Katalog Layanan Publik</span>
            <h1 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                Layanan Administrasi & Perizinan Warga
            </h1>
            <p class="text-xs sm:text-sm text-gray-600 max-w-2xl leading-relaxed">
                Panduan lengkap alur tahapan, persyaratan berkas, dan estimasi waktu penyelesaian layanan kependudukan di Kelurahan Sukawarna. Bebas biaya dan transparan.
            </p>
        </div>

        <!-- Timeline Stepper UI/UX Component (Reference Fidelity) -->
        <x-ui.timeline-stepper 
            :title="'ALUR TAHAPAN & ESTIMASI WAKTU PELAYANAN'"
        />

        <!-- Layanan Category Cards -->
        <div class="space-y-10 pt-4">
            @foreach($layananGrouped as $kategori => $daftarLayanan)
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="w-3.5 h-3.5 rounded-full bg-[#FFB703]"></span>
                        <h2 class="font-serif font-bold text-2xl text-[#1B4332]">Layanan {{ $kategori }}</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($daftarLayanan as $lay)
                            <div class="bg-white rounded-2xl p-6 border border-gray-200/90 shadow-sm hover:shadow-md transition-shadow space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="font-serif font-bold text-lg text-[#1B4332]">{{ $lay->nama_layanan }}</h3>
                                        <div class="flex items-center gap-2 text-xs mt-1">
                                            <span class="px-2.5 py-0.5 rounded-full bg-[#0284C7]/15 text-[#0284C7] font-semibold">{{ $lay->waktu_penyelesaian }}</span>
                                            <span class="font-bold text-emerald-700">{{ $lay->biaya }}</span>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($lay->persyaratan))
                                    <div class="space-y-1.5 text-xs">
                                        <strong class="text-[#1B4332] block">Persyaratan Dokumen:</strong>
                                        <ul class="list-disc list-inside space-y-1 text-gray-600">
                                            @foreach($lay->persyaratan as $syarat)
                                                <li>{{ $syarat }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($lay->alur_pelayanan)
                                    <div class="p-3.5 rounded-xl bg-sky-50/50 border border-sky-100 text-xs text-gray-700">
                                        <strong class="text-[#0369A1] block mb-1">Rincian Alur:</strong>
                                        <p>{{ $lay->alur_pelayanan }}</p>
                                    </div>
                                @endif

                                <!-- Interactive Action Buttons (Checklist Mandiri & Helpdesk WA) -->
                                <div class="pt-3 border-t border-gray-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-2.5">
                                    <button type="button" 
                                            class="open-checklist-btn flex-1 inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-[#2D6A4F] hover:bg-[#1B4332] text-white text-xs font-bold shadow-2xs transition-all"
                                            data-service-id="{{ $lay->id }}"
                                            data-service-name="{{ $lay->nama_layanan }}"
                                            data-service-time="{{ $lay->waktu_penyelesaian }}"
                                            data-service-requirements="{{ json_encode($lay->persyaratan ?? []) }}">
                                        <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Cek Kelengkapan Mandiri</span>
                                    </button>

                                    <a href="https://wa.me/628122012345?text={{ urlencode('Halo Petugas Pelayanan Kelurahan Sukawarna, saya ingin konsultasi mengenai persyaratan untuk: ' . $lay->nama_layanan) }}" 
                                       target="_blank" 
                                       rel="noopener noreferrer" 
                                       class="inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl border border-gray-200 hover:border-emerald-500 hover:text-emerald-700 text-gray-600 text-xs font-semibold transition-colors">
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                        <span>Tanya WA</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- MODAL 1: Interactive Self-Assessment Checklist -->
    <div id="checklist-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-5 shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between gap-4 pb-3 border-b border-gray-100">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#FFB703] block">Simulasi Persiapan Berkas</span>
                    <h3 id="modal-service-title" class="font-serif font-black text-xl text-[#1B4332] leading-tight"></h3>
                    <span id="modal-service-time" class="text-xs text-[#0284C7] font-semibold block mt-0.5"></span>
                </div>
                <button type="button" id="close-checklist-btn" class="text-gray-400 hover:text-gray-700 p-1 rounded-full text-xl leading-none">
                    &times;
                </button>
            </div>

            <!-- Progress Bar -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between text-xs font-bold">
                    <span class="text-gray-600">Status Kesiapan Berkas:</span>
                    <span id="checklist-progress-text" class="text-[#2D6A4F] font-mono">0% (0/0)</span>
                </div>
                <div class="w-full h-2.5 rounded-full bg-gray-100 overflow-hidden">
                    <div id="checklist-progress-bar" class="h-full bg-[#52B788] transition-all duration-300 w-0"></div>
                </div>
            </div>

            <!-- Checkbox List -->
            <div class="space-y-2.5 pt-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-[#1B4332] block">Centang dokumen yang sudah Anda siapkan:</span>
                    <a href="{{ route('dokumen.index') }}" target="_blank" class="text-[11px] font-bold text-[#0284C7] hover:underline flex items-center gap-1">
                        <span>Unduh Blangko Surat &rarr;</span>
                    </a>
                </div>
                <div id="checklist-items-container" class="space-y-2"></div>
            </div>

            <!-- 100% Celebration Banner -->
            <div id="checklist-complete-banner" class="hidden p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 space-y-2 text-xs">
                <div class="flex items-center gap-2 font-bold text-emerald-800">
                    <span class="text-lg">🎉</span>
                    <span>Berkas Anda 100% Lengkap & Siap!</span>
                </div>
                <p class="leading-relaxed text-[11px] text-emerald-700">
                    Anda berhak mengakses <strong>Antrean Jalur Cepat (Fast Track)</strong> di loket pelayanan Kelurahan Sukawarna.
                </p>
            </div>

            <div class="pt-3 border-t border-gray-100 flex items-center justify-between gap-3">
                <button type="button" id="cancel-checklist-btn" class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-bold text-xs hover:bg-gray-50">
                    Tutup
                </button>
                <button type="button" 
                        id="generate-qr-proof-btn" 
                        disabled
                        class="flex-1 px-4 py-2.5 rounded-xl bg-gray-200 text-gray-400 font-bold text-xs transition-all flex items-center justify-center gap-2 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    <span>Cetak Lembar Pra-Validasi (QR)</span>
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL 2: Printable Lembar Pra-Validasi Ber-QR Code -->
    <div id="proof-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl border-2 border-emerald-500/40 print:m-0 print:p-0 print:border-none print:shadow-none">
            <!-- Official Header -->
            <div class="text-center border-b-2 border-[#1B4332] pb-4 space-y-1">
                <span class="text-[10px] font-bold tracking-widest text-gray-500 uppercase block">PEMERINTAH KOTA BANDUNG &bull; KECAMATAN SUKASARI</span>
                <h2 class="font-serif font-black text-xl text-[#1B4332] tracking-tight">KELURAHAN SUKAWARNA</h2>
                <span class="text-[11px] font-bold text-[#FFB703] uppercase tracking-wider block">LEMBAR BUKTI PRA-VALIDASI DOKUMEN (FAST TRACK)</span>
            </div>

            <!-- Voucher Content -->
            <div class="space-y-4 text-xs">
                <div class="flex items-center justify-between bg-emerald-50 p-3.5 rounded-2xl border border-emerald-200">
                    <div>
                        <span class="text-[10px] text-gray-500 block">KODE VALIDASI:</span>
                        <strong id="proof-code" class="font-mono text-sm text-[#1B4332]">FAST-SKW-2026-98213</strong>
                    </div>
                    <span class="px-2.5 py-1 rounded-full bg-emerald-600 text-white font-black text-[10px] uppercase">
                        ✓ Siap Loket
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <span class="text-gray-400 block text-[10px]">Layanan:</span>
                        <strong id="proof-service-name" class="text-[#1B4332]"></strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">Waktu Verifikasi:</span>
                        <strong id="proof-timestamp" class="text-[#1B4332]"></strong>
                    </div>
                </div>

                <div>
                    <span class="text-gray-400 block text-[10px] mb-1">Daftar Dokumen yang Telah Diverifikasi Lengkap:</span>
                    <ul id="proof-checklist-items" class="list-disc list-inside space-y-0.5 text-gray-700 bg-gray-50 p-3 rounded-xl border border-gray-100"></ul>
                </div>

                <!-- QR Code Box -->
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <img id="proof-qr-img" src="" alt="QR Validasi" class="w-24 h-24 rounded-lg bg-white border border-gray-200 p-1 flex-shrink-0">
                    <div class="space-y-1 text-[11px]">
                        <strong class="text-[#1B4332] block">Tunjukkan QR Code Ini di Loket</strong>
                        <p class="text-gray-500 leading-relaxed">
                            Petugas front-office kelurahan akan memindai QR ini untuk memasukkan Anda ke antrean prioritas verifikasi fisik.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-2 border-t border-gray-100 flex items-center justify-between gap-3 print:hidden">
                <button type="button" id="close-proof-btn" class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 font-bold text-xs hover:bg-gray-50">
                    Tutup
                </button>
                <button type="button" onclick="window.print()" class="px-6 py-2 rounded-xl bg-[#1B4332] text-[#FFB703] font-bold text-xs hover:bg-[#2D6A4F] flex items-center gap-1.5 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>Cetak Lembar Validasi</span>
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const checklistModal = document.getElementById('checklist-modal');
        const proofModal = document.getElementById('proof-modal');
        const modalServiceTitle = document.getElementById('modal-service-title');
        const modalServiceTime = document.getElementById('modal-service-time');
        const itemsContainer = document.getElementById('checklist-items-container');
        const progressBar = document.getElementById('checklist-progress-bar');
        const progressText = document.getElementById('checklist-progress-text');
        const completeBanner = document.getElementById('checklist-complete-banner');
        const generateQrBtn = document.getElementById('generate-qr-proof-btn');

        let currentServiceName = '';
        let currentRequirements = [];

        document.querySelectorAll('.open-checklist-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                currentServiceName = btn.dataset.serviceName;
                const time = btn.dataset.serviceTime;
                try {
                    currentRequirements = JSON.parse(btn.dataset.serviceRequirements || '[]');
                } catch(e) {
                    currentRequirements = [];
                }

                modalServiceTitle.textContent = currentServiceName;
                modalServiceTime.textContent = 'Estimasi Pelayanan: ' + time;

                renderChecklist();
                checklistModal.classList.remove('hidden');
            });
        });

        function renderChecklist() {
            itemsContainer.innerHTML = '';
            if (currentRequirements.length === 0) {
                itemsContainer.innerHTML = '<p class="text-xs text-gray-500 italic">Tidak ada berkas khusus yang disyaratkan.</p>';
                updateProgress(1, 1);
                return;
            }

            currentRequirements.forEach((req, idx) => {
                const label = document.createElement('label');
                label.className = 'flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:bg-emerald-50/50 cursor-pointer transition-colors';
                label.innerHTML = `
                    <input type="checkbox" class="checklist-item-check w-4 h-4 text-[#2D6A4F] rounded border-gray-300 focus:ring-[#52B788]">
                    <span class="text-xs text-gray-700 font-medium">${req}</span>
                `;
                itemsContainer.appendChild(label);
            });

            itemsContainer.querySelectorAll('.checklist-item-check').forEach(chk => {
                chk.addEventListener('change', checkProgress);
            });

            checkProgress();
        }

        function checkProgress() {
            const checkboxes = itemsContainer.querySelectorAll('.checklist-item-check');
            const total = checkboxes.length;
            if (total === 0) {
                updateProgress(1, 1);
                return;
            }

            const checkedCount = Array.from(checkboxes).filter(c => c.checked).length;
            updateProgress(checkedCount, total);
        }

        function updateProgress(checked, total) {
            const pct = Math.round((checked / total) * 100);
            progressBar.style.width = pct + '%';
            progressText.textContent = `${pct}% (${checked}/${total})`;

            if (pct === 100) {
                completeBanner.classList.remove('hidden');
                generateQrBtn.disabled = false;
                generateQrBtn.classList.remove('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                generateQrBtn.classList.add('bg-[#FFB703]', 'text-[#1B4332]', 'hover:scale-[1.02]', 'shadow-sm');
            } else {
                completeBanner.classList.add('hidden');
                generateQrBtn.disabled = true;
                generateQrBtn.classList.add('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                generateQrBtn.classList.remove('bg-[#FFB703]', 'text-[#1B4332]', 'hover:scale-[1.02]', 'shadow-sm');
            }
        }

        // Close Checklist
        document.getElementById('close-checklist-btn').addEventListener('click', () => checklistModal.classList.add('hidden'));
        document.getElementById('cancel-checklist-btn').addEventListener('click', () => checklistModal.classList.add('hidden'));

        // Generate Proof Modal
        generateQrBtn.addEventListener('click', () => {
            checklistModal.classList.add('hidden');

            const randomCode = 'FAST-SKW-' + Math.floor(10000 + Math.random() * 90000);
            document.getElementById('proof-code').textContent = randomCode;
            document.getElementById('proof-service-name').textContent = currentServiceName;
            
            const now = new Date();
            document.getElementById('proof-timestamp').textContent = now.toLocaleDateString('id-ID', {
                day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit'
            }) + ' WIB';

            const proofList = document.getElementById('proof-checklist-items');
            proofList.innerHTML = '';
            currentRequirements.forEach(r => {
                const li = document.createElement('li');
                li.textContent = r;
                proofList.appendChild(li);
            });

            const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent('https://sukawarna.bandung.go.id/validasi/' + randomCode)}`;
            document.getElementById('proof-qr-img').src = qrUrl;

            proofModal.classList.remove('hidden');
        });

        document.getElementById('close-proof-btn').addEventListener('click', () => proofModal.classList.add('hidden'));
    });
    </script>
    @endpush
</x-layouts.app>
