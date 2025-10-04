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




// ======================= products =========================
// Add this to your existing JavaScript file
class StatsAnimator {
    constructor() {
        this.animated = false;
    }

    init() {
        this.observeStatsSection();
        this.setupHoverEffects();
    }

    observeStatsSection() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !this.animated) {
                    this.animateCounters();
                    this.animated = true;
                }
            });
        }, { threshold: 0.5 });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }
    }

    animateCounters() {
        const counters = document.querySelectorAll('.stat-info h3');
        
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            const duration = 2000; // 2 seconds
            const step = target / (duration / 16); // 60fps
            let current = 0;
            
            counter.classList.add('animating');
            
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    counter.textContent = this.formatNumber(target);
                    clearInterval(timer);
                    counter.classList.remove('animating');
                } else {
                    counter.textContent = this.formatNumber(Math.floor(current));
                }
            }, 16);
        });
    }

    formatNumber(num) {
        if (num >= 1000000) {
            return (num / 1000000).toFixed(1) + 'M';
        } else if (num >= 1000) {
            return (num / 1000).toFixed(1) + 'K';
        }
        return num.toString();
    }

    setupHoverEffects() {
        const statCards = document.querySelectorAll('.stat-card');
        
        statCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });
    }
}

// Initialize stats animator
document.addEventListener('DOMContentLoaded', () => {
    const statsAnimator = new StatsAnimator();
    statsAnimator.init();
});

// Update stats function for your ProductManager class
function updateStats() {
    const totalProducts = this.products.length;
    const activeProducts = this.products.filter(p => p.status === 'active').length;
    const outOfStock = this.products.filter(p => p.stock === 0).length;
    const categories = new Set(this.products.map(p => p.category)).size;
    
    // Update DOM elements
    document.getElementById('totalProducts').textContent = totalProducts;
    document.getElementById('activeProducts').textContent = activeProducts;
    document.getElementById('outOfStock').textContent = outOfStock;
    document.getElementById('totalCategories').textContent = categories;
    
    // Trigger animation if stats are visible
    const statsSection = document.querySelector('.stats-section');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                statsAnimator.animateCounters();
            }
        });
    });
    
    if (statsSection) {
        observer.observe(statsSection);
    }
}



// ======================= add products =========================
