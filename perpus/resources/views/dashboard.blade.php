<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">

    @can('admin')

        <x-card cardTitle='Siswa' icon='bi-person'>{{ $siswa }}</x-card>
        @can('bigAdmin')
            <x-card cardTitle='Petugas' icon='bi-person-badge'>{{ $petugas }}</x-card>
        @endcan
        <x-card cardTitle='Kelas' icon='bi-house'>{{ $kelas }}</x-card>
    @endcan

    <x-card cardTitle='Buku' icon='bi-book'>{{ $buku->count() }}</x-card>
    <x-card cardTitle='Denda' icon='bi-exclamation-circle'>{{ $denda->count() }}</x-card>
    <x-card cardTitle='Peminjaman' icon='bi-clipboard-minus'>{{ $peminjaman->count() }}</x-card>
    <x-card cardTitle='Pengembalian' icon='bi-repeat'>{{ $pengembalian->count() }}</x-card>

    @if (Session::has('toastSuccess'))
        <script>
            toastr.success("{{ Session::get('toastSuccess') }}");
        </script>
    @endif

    @can('admin')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan <span>/Bulanan</span></h5>

                    <!-- Line Chart -->
                    <canvas id="lineChart" style="max-height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const chartData = {!! json_encode($chartData) !!};
                            new Chart(document.querySelector('#lineChart'), {
                                type: 'line',
                                data: chartData,
                            });
                        });
                    </script>
                    <!-- End Line CHart -->

                </div>

            </div>
        </div><!-- End Reports -->
    @endcan

</x-layouts.main>
