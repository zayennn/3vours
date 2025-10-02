// Toggle sidebar di mobile
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');
    
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
    
    // Generate chart data untuk statistik pengunjung
    generateVisitorChart();
    
    // Generate chart data untuk pendapatan
    generateRevenueChart();
    
    // Tambahkan efek hover pada cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Tambahkan interaksi pada menu navigasi
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            navItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            // Tutup sidebar di mobile setelah memilih menu
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
            }
        });
    });
});

// Fungsi untuk generate chart pengunjung
function generateVisitorChart() {
    const chartContainer = document.getElementById('visitorChart');
    const days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
    const data = [120, 190, 300, 500, 200, 300, 450];
    
    chartContainer.innerHTML = '';
    
    days.forEach((day, index) => {
        const barHeight = (data[index] / 600) * 100;
        
        const bar = document.createElement('div');
        bar.className = 'chart-bar';
        bar.style.height = `${barHeight}%`;
        
        const label = document.createElement('div');
        label.className = 'chart-bar-label';
        label.textContent = day;
        
        bar.appendChild(label);
        chartContainer.appendChild(bar);
        
        // Tambahkan tooltip
        bar.setAttribute('title', `${data[index]} pengunjung`);
    });
}

// Fungsi untuk generate chart pendapatan
function generateRevenueChart() {
    const chartContainer = document.getElementById('revenueChart');
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
    const data = [12000, 19000, 30000, 25000, 22000, 28000];
    
    chartContainer.innerHTML = '';
    
    months.forEach((month, index) => {
        const barHeight = (data[index] / 40000) * 100;
        
        const bar = document.createElement('div');
        bar.className = 'chart-bar';
        bar.style.height = `${barHeight}%`;
        
        // Warna berbeda untuk chart pendapatan
        bar.style.background = '#10b981';
        
        const label = document.createElement('div');
        label.className = 'chart-bar-label';
        label.textContent = month;
        
        bar.appendChild(label);
        chartContainer.appendChild(bar);
        
        // Tambahkan tooltip
        bar.setAttribute('title', `$${data[index].toLocaleString()}`);
    });
}

// Fungsi untuk update data secara real-time (simulasi)
function updateStats() {
    // Simulasi update data statistik
    const cardValues = document.querySelectorAll('.card-value');
    
    cardValues.forEach((value, index) => {
        const currentValue = parseInt(value.textContent.replace(/[^0-9]/g, ''));
        const change = Math.floor(Math.random() * 100) - 30; // Perubahan acak antara -30 dan +70
        
        // Update nilai dengan animasi
        animateValue(value, currentValue, currentValue + change, 1000);
    });
    
    // Update chart setelah 5 detik
    setTimeout(() => {
        generateVisitorChart();
        generateRevenueChart();
    }, 5000);
}

// Fungsi untuk animasi perubahan nilai
function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        
        // Format angka dengan pemisah ribuan
        const value = Math.floor(progress * (end - start) + start);
        element.textContent = value.toLocaleString();
        
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Update data setiap 10 detik (simulasi)
setInterval(updateStats, 10000);

// Tambahkan event listener untuk filter chart
document.querySelectorAll('.chart-filter').forEach(filter => {
    filter.addEventListener('change', function() {
        // Dalam implementasi nyata, ini akan memuat data baru berdasarkan filter
        // Di sini kita hanya akan mengacak data untuk simulasi
        if (this.parentElement.parentElement.querySelector('h2').textContent === 'Statistik Pengunjung') {
            generateVisitorChart();
        } else {
            generateRevenueChart();
        }
    });
});