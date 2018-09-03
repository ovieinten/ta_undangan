<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">--- MAIN</li>
                <li> <a class="" href="{{route('backend.dashboard.index')}}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                @if(Auth::user()->role_id == '1')
                <li> <a class="" href="{{route('backend.category.index')}}" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Kategori</span></a>
                </li>
                @endif
                <li> <a class="" href="{{route('backend.shape.index')}}" aria-expanded="false"><i class="ti-layers"></i><span class="hide-menu">Bentuk</span></a>
                </li>
                <li> <a class="" href="{{route('backend.size.index')}}" aria-expanded="false"><i class="ti-target"></i><span class="hide-menu">Ukuran</span></a>
                </li>
                <li> <a class="" href="{{route('backend.color.index')}}" aria-expanded="false"><i class="ti-palette"></i><span class="hide-menu">Warna</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="icon-layers"></i><span class="hide-menu">Produk</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('backend.product.form')}}">Buat Baru</a></li>
                        <li><a href="{{route('backend.product.index')}}">Semua Produk</a></li>
                        <li><a href="{{route('backend.product.published')}}">Published</a></li>
                        <li><a href="{{route('backend.product.drafted')}}">Drafted</a></li>
                        <li><a href="{{route('backend.product.trashed')}}">Trash</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class=" ti-layout-media-right-alt"></i><span class="hide-menu">Karya</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('backend.creation.form')}}">Buat Baru</a></li>
                        <li><a href="{{route('backend.creation.index')}}">Semua Karya</a></li>
                        <li><a href="{{route('backend.creation.sent')}}">Sent</a></li>
                        <li><a href="{{route('backend.creation.accepted')}}">Accepted</a></li>
                    </ul>
                </li>
                <li> <a class="" href="{{route('backend.discount.index')}}" aria-expanded="false"><i class=" ti-money"></i><span class="hide-menu">Diskon</span></a>
                </li>
                <li> <a class="" href="{{route('backend.gallery.index')}}" aria-expanded="false"><i class="ti-gallery"></i><span class="hide-menu">Galeri</span></a>
                </li>
                <li class="nav-small-cap">--- MARKETING</li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="ti-notepad"></i><span class="hide-menu">Pemesanan</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('backend.order.form')}}">Buat Baru</a></li>
                        <li><a href="{{route('backend.order.index')}}">Semua Pesanan</a></li>
                        <li><a href="{{route('backend.order.confirmed')}}">Konfirmasi Pembayaran</a></li>
                        <li><a href="{{route('backend.order.packed')}}">Pengemasan</a></li>
                        <li><a href="{{route('backend.order.shippedOut')}}">Pengiriman</a></li>
                        <li><a href="{{route('backend.order.delivered')}}">Barang Sampai</a></li>
                        <li><a href="{{route('backend.order.trashed')}}">Cancel</a></li>
                    </ul>
                </li>
                <li> <a class="" href="{{route('backend.payment.index')}}" aria-expanded="false"><i class="icon-credit-card"></i><span class="hide-menu">Pembayaran</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="icon-chart"></i><span class="hide-menu">Penjualan</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('backend.sale.index')}}">Semua Penjualan</a></li>
                        <li><a href="{{route('backend.sale.formReport')}}">Laporan Penjualan</a></li>
                    </ul>
                </li>
                <li class="nav-small-cap">--- USERS</li>
                <li> <a class="" href="{{route('posts')}}" aria-expanded="false"><i class="icon-star"></i><span class="hide-menu">Rating</span></a>
                </li>
                <li> <a class="" href="{{route('backend.user.index')}}" aria-expanded="false"><i class="icon-people"></i><span class="hide-menu">Users</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>