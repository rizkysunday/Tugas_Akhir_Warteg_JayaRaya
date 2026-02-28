// ===========================================
// 1. FITUR DARK MODE (LocalStorage)
// ===========================================
const btnTheme = document.getElementById('btn-theme');
const body = document.body;

// Cek apakah ada simpanan tema di browser
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    btnTheme.innerText = "Mode Terang";
}

btnTheme.addEventListener('click', function() {
    body.classList.toggle('dark-mode');

    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        btnTheme.innerText = "Mode Terang";
    } else {
        localStorage.removeItem('theme');
        btnTheme.innerText = "Mode Gelap";
    }
});

// ===========================================
// 2. DATA MENU & WISHLIST (SessionStorage)
// ===========================================
let wishlist = [];

// Load wishlist dari sessionStorage jika ada
if (sessionStorage.getItem('wishlist')) {
    wishlist = JSON.parse(sessionStorage.getItem('wishlist'));
}

// Update badge wishlist saat halaman dimuat
updateWishlistCount();

// ===========================================
// 3. FITUR BELI (Pengelolaan Stok)
// ===========================================
function aktifkanTombolBeli() {
    const tombolBeli = document.querySelectorAll('.btn-detail');
    
    tombolBeli.forEach(function(button) {
        // Clone untuk hapus event listener lama
        button.replaceWith(button.cloneNode(true));
    });
    
    const tombolBaru = document.querySelectorAll('.btn-detail');
    tombolBaru.forEach(function(button) {
        button.addEventListener('click', function(e) {
            const cardBody = e.target.closest('.card-body');
            const stokElement = cardBody.querySelector('.stok-text');
            let stok = parseInt(stokElement.innerText.replace("Stok: ", ""));
            
            if (stok > 0) {
                stok--;
                stokElement.innerText = "Stok: " + stok;
                const namaBarang = cardBody.querySelector('.card-title').innerText;
                alert("Berhasil membeli " + namaBarang);
            } else {
                alert("Stok Habis!");
                e.target.disabled = true;
                e.target.innerText = "Habis";
            }
        });
    });
}

// ===========================================
// 4. FITUR WISHLIST (SessionStorage & Modal)
// ===========================================
function aktifkanTombolWishlist() {
    const tombolWishlist = document.querySelectorAll('.btn-wishlist');
    
    tombolWishlist.forEach(function(button) {
        // Clone untuk hapus event listener lama
        button.replaceWith(button.cloneNode(true));
    });
    
    const tombolBaru = document.querySelectorAll('.btn-wishlist');
    tombolBaru.forEach(function(button) {
        button.addEventListener('click', function(e) {
            const cardBody = e.target.closest('.card-body');
            const namaBarang = cardBody.querySelector('.card-title').innerText;
            const hargaText = cardBody.querySelector('p').innerText;
            const harga = parseInt(hargaText.replace(/[^0-9]/g, ''));
            
            // Buat object item
            const item = {
                id: Date.now(), // ID unik berdasarkan timestamp
                nama: namaBarang,
                harga: harga
            };
            
            // Tambah ke wishlist
            wishlist.push(item);
            
            // Simpan ke sessionStorage
            sessionStorage.setItem('wishlist', JSON.stringify(wishlist));
            
            // Ubah tampilan tombol
            e.target.classList.remove('btn-outline-danger');
            e.target.classList.add('btn-danger');
            e.target.innerHTML = '❤️ Di Wishlist';
            
            // Update badge
            updateWishlistCount();
            
            alert("Berhasil menambahkan " + namaBarang + " ke wishlist");
        });
    });
}

// ===========================================
// 5. UPDATE BADGE WISHLIST
// ===========================================
function updateWishlistCount() {
    const wishlistCount = document.getElementById('wishlist-count');
    if (wishlistCount) {
        wishlistCount.innerText = wishlist.length;
    }
}

// ===========================================
// 6. TAMPILKAN WISHLIST DI MODAL
// ===========================================
function tampilkanWishlist() {
    const wishlistList = document.getElementById('wishlist-list');
    const wishlistKosong = document.getElementById('wishlist-kosong');
    
    wishlistList.innerHTML = '';
    
    if (wishlist.length === 0) {
        wishlistKosong.style.display = 'block';
        return;
    }
    
    wishlistKosong.style.display = 'none';
    
    wishlist.forEach(function(item, index) {
        const row = document.createElement('li');
        row.className = 'list-group-item d-flex justify-content-between align-items-center';
        row.innerHTML = `
            <div>
                <strong>${item.nama}</strong><br>
                <small>Rp ${item.harga.toLocaleString()}</small>
            </div>
            <button class="btn btn-sm btn-danger" onclick="hapusDariWishlist(${index})">
                <i class="bi bi-trash"></i>
            </button>
        `;
        wishlistList.appendChild(row);
    });
}

// ===========================================
// 7. HAPUS ITEM DARI WISHLIST (BONUS)
// ===========================================
function hapusDariWishlist(index) {
    const item = wishlist[index];
    
    // Hapus dari array
    wishlist.splice(index, 1);
    
    // Update sessionStorage
    sessionStorage.setItem('wishlist', JSON.stringify(wishlist));
    
    // Update tampilan modal
    tampilkanWishlist();
    
    // Update badge
    updateWishlistCount();
    
    // Kembalikan tombol wishlist ke status semula
    const cards = document.querySelectorAll('.card');
    cards.forEach(function(card) {
        const title = card.querySelector('.card-title');
        if (title && title.innerText === item.nama) {
            const wishlistBtn = card.querySelector('.btn-wishlist');
            if (wishlistBtn) {
                wishlistBtn.classList.remove('btn-danger');
                wishlistBtn.classList.add('btn-outline-danger');
                wishlistBtn.innerHTML = '❤️ Wishlist';
            }
        }
    });
    
    alert("Menghapus " + item.nama + " dari wishlist");
}

// ===========================================
// 8. KOSONGKAN WISHLIST
// ===========================================
function kosongkanWishlist() {
    if (wishlist.length > 0) {
        // Reset semua tombol wishlist
        const wishlistBtns = document.querySelectorAll('.btn-wishlist');
        wishlistBtns.forEach(function(button) {
            button.classList.remove('btn-danger');
            button.classList.add('btn-outline-danger');
            button.innerHTML = '❤️ Wishlist';
        });
        
        // Kosongkan array
        wishlist = [];
        
        // Update sessionStorage
        sessionStorage.setItem('wishlist', JSON.stringify(wishlist));
        
        // Update tampilan modal
        tampilkanWishlist();
        
        // Update badge
        updateWishlistCount();
        
        alert('Wishlist telah dikosongkan');
    }
}

// ===========================================
// 9. CEK STATUS WISHLIST SAAT INIT
// ===========================================
function cekStatusWishlist() {
    const cards = document.querySelectorAll('.card');
    
    cards.forEach(function(card) {
        const title = card.querySelector('.card-title');
        const wishlistBtn = card.querySelector('.btn-wishlist');
        
        if (title && wishlistBtn) {
            const adaDiWishlist = wishlist.some(item => item.nama === title.innerText);
            
            if (adaDiWishlist) {
                wishlistBtn.classList.remove('btn-outline-danger');
                wishlistBtn.classList.add('btn-danger');
                wishlistBtn.innerHTML = '❤️ Di Wishlist';
            }
        }
    });
}

// ===========================================
// 10. INITIALIZATION (MENJALANKAN SEMUA FUNGSI)
// ===========================================
document.addEventListener('DOMContentLoaded', function() {
    aktifkanTombolBeli();
    aktifkanTombolWishlist();
    cekStatusWishlist();
    updateWishlistCount();
    
    console.log("Sistem Warung Nasi Jaya Raya siap digunakan!");
    console.log("Total item di wishlist:", wishlist.length);
});

// ===========================================
// 11. EXPOSE FUNGSI KE GLOBAL SCOPE
// ===========================================
window.tampilkanWishlist = tampilkanWishlist;
window.hapusDariWishlist = hapusDariWishlist;
window.kosongkanWishlist = kosongkanWishlist;