<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <x-card cardTitle='Siswa' icon='bi-person'>300</x-card>
    <x-card cardTitle='Petugas' icon='bi-person-badge'>5</x-card>
    <x-card cardTitle='Kelas' icon='bi-house'>8</x-card>
    <x-card cardTitle='Buku' icon='bi-book'>138</x-card>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Laporan <span>/Bulanan</span></h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 400px;"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        new Chart(document.querySelector('#lineChart'), {
                            type: 'line',
                            data: {
                                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                datasets: [{
                                        label: 'Peminjaman',
                                        data: [65, 59, 80, 81, 56, 55, 40],
                                        fill: false,
                                        borderColor: 'rgb(75, 192, 192)',
                                        tension: 0.1
                                    },
                                    {
                                        label: 'Buku Masuk',
                                        data: [20, 40, 74, 10, 34, 67, 30],
                                        fill: false,
                                        borderColor: 'rgb(38, 232, 35)',
                                        tension: 0.1
                                    },
                                    {
                                        label: 'Buku Rusak',
                                        data: [20, 15, 12, 4, 8, 10, 1],
                                        fill: false,
                                        borderColor: 'rgb(196, 22, 54)',
                                        tension: 0.1
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                </script>
                <!-- End Line CHart -->


            </div>

        </div>
    </div><!-- End Reports -->
</x-layouts.main>
