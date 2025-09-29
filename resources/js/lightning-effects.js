/**
 * Hiệu ứng đom đóm, sao băng và mạng nhện cho các card
 * ShopBuffSao
 */

// Khởi tạo hiệu ứng
function initLightningEffects() {
    // Tạo các hạt đom đóm cho tất cả card nếu chưa có
    addParticlesToCards();

    // Khởi tạo các hiệu ứng ngẫu nhiên
    initRandomParticles();
    
    // Tạo mạng nhện
    createWebLines();
    
    // Lên lịch cập nhật
    scheduleLightningUpdates();
    
    // Áp dụng CSS để đảm bảo hiệu ứng nằm trong card
    applyContainmentCSS();
}

// Thêm các hạt đom đóm cho card nếu chưa có
function addParticlesToCards() {
    const cards = document.querySelectorAll('.card.lightning-effect');
    
    cards.forEach(card => {
        // Kiểm tra xem đã có các hạt hay chưa
        const existingParticles = card.querySelectorAll('.floating-particle');
        
        // Nếu chưa có các hạt, thêm vào
        if (existingParticles.length === 0) {
            // Thêm 8 hạt
            for (let i = 1; i <= 8; i++) {
                const particle = document.createElement('div');
                particle.className = `floating-particle p${i}`;
                card.prepend(particle);
            }
        }
        
        // Kiểm tra xem đã có container mạng nhện chưa
        let webContainer = card.querySelector('.web-container');
        
        // Nếu chưa có, thêm vào
        if (!webContainer) {
            webContainer = document.createElement('div');
            webContainer.className = 'web-container';
            card.prepend(webContainer);
        }
        
        // Tìm phần tử ảnh hoặc div chứa ảnh
        const imageContainer = card.querySelector('.relative') || card.querySelector('.overflow-hidden') || card;
        
        // Kiểm tra xem đã có sao băng chưa (kiểm tra cả trong image container và trong card)
        const existingStars = card.querySelectorAll('.shooting-star');
        
        // Nếu chưa có, thêm vào phần tử chứa ảnh
        if (existingStars.length === 0) {
            // Tìm container chứa ảnh để thêm sao băng vào
            const imageContainer = card.querySelector('.relative') || card.querySelector('.overflow-hidden') || card;
            
            // Thêm vào container chứa ảnh để hiển thị trên ảnh
            for (let i = 1; i <= 3; i++) {
                const star = document.createElement('div');
                star.className = `shooting-star shooting-star-${i}`;
                imageContainer.appendChild(star);
                
                // Thêm style inline để đảm bảo hiển thị đúng
                star.style.zIndex = '20';
                star.style.top = `-${60 + i * 10}px`;
                star.style.left = `${20 + i * 20}%`;
                star.style.transform = `rotate(${5 + i * 10}deg)`;
            }
        } else {
            // Đảm bảo tất cả các sao băng đã có z-index cao
            existingStars.forEach(star => {
                star.style.zIndex = '20';
            });
        }
    });
}

// Khởi tạo và cập nhật các hạt ngẫu nhiên
function initRandomParticles() {
    // Lấy tất cả các thẻ có class lightning-effect
    const cards = document.querySelectorAll('.card.lightning-effect');
    
    // Với mỗi card, thêm các biến CSS tùy chỉnh ngẫu nhiên
    cards.forEach(card => {
        // Lấy tất cả các hạt trong card
        const particles = card.querySelectorAll('.floating-particle');
        
        // Cập nhật mỗi hạt
        particles.forEach((particle, index) => {
            const particleIndex = index + 1; // p1, p2, ..., p8
            updateParticleProperties(particle, particleIndex, card);
        });
    });
}

// Hàm cập nhật thuộc tính cho một hạt
function updateParticleProperties(particle, particleIndex, card) {
    // Đảm bảo hạt không di chuyển ra ngoài phạm vi của card
    const cardWidth = card.offsetWidth;
    const cardHeight = card.offsetHeight;
    
    // Tạo biến để theo dõi hoạt động cập nhật
    if (!particle.dataset.updating) {
        particle.dataset.updating = "false";
    }
    
    // Bỏ qua nếu hạt đang trong quá trình cập nhật
    if (particle.dataset.updating === "true") {
        return;
    }
    
    // Đánh dấu hạt đang được cập nhật
    particle.dataset.updating = "true";
    
    // Giới hạn các giá trị random để hạt không di chuyển quá xa
    const maxOffset = Math.min(20, cardWidth * 0.1, cardHeight * 0.1);
    const randomOffset = Math.floor(Math.random() * maxOffset);
    
    // Delay ngẫu nhiên
    const randomDelay = (Math.random() * 2).toFixed(2);
    card.style.setProperty(`--random-delay${particleIndex}`, `${randomDelay}s`);
    
    // Giới hạn vị trí tùy chọn (đảm bảo nằm trong card)
    const maxPosition = 40; // Phần trăm
    const randomPosition = Math.floor(Math.random() * maxPosition);
    
    // Giới hạn các giá trị X, Y cho đường đi
    const maxDelta = Math.min(15, cardWidth * 0.05, cardHeight * 0.05);
    const randomX = Math.floor(Math.random() * maxDelta);
    const randomY = Math.floor(Math.random() * maxDelta);
    
    // Cập nhật các thuộc tính CSS với giá trị đã giới hạn
    card.style.setProperty(`--random-offset${particleIndex}`, `${randomOffset}px`);
    card.style.setProperty(`--random-position${particleIndex}`, `${randomPosition}%`);
    card.style.setProperty(`--random-x${particleIndex}`, `${randomX}px`);
    card.style.setProperty(`--random-y${particleIndex}`, `${randomY}px`);
    
    // Reset animation
    // Lưu lại class hiện tại
    const currentClass = particle.className;
    
    // Tạm thời xóa class p[1-8] để reset animation
    particle.className = currentClass.replace(/p[1-8]/, '');
    
    // Đặt lại opacity
    particle.style.opacity = '0';
    
    // Thêm class lại sau một khoảng thời gian để bắt đầu animation mới
    setTimeout(() => {
        particle.className = currentClass;
        
        // Áp dụng transition cho fade-in từ từ
        setTimeout(() => {
            // Thay đổi transition để xuất hiện từ từ
            particle.style.transition = 'opacity 1.8s ease-in, transform 3s ease-out';
            
            // Độ sáng ngẫu nhiên
            const randomBrightness = 0.7 + Math.random() * 0.3;
            particle.style.opacity = randomBrightness.toString();
            
            // Xóa trạng thái đang cập nhật khi animation đã bắt đầu
            setTimeout(() => {
                particle.dataset.updating = "false";
            }, 500);
        }, 100);
    }, 50);
}

// Tạo các đường mạng nhện kết nối
function createWebLines() {
    const cards = document.querySelectorAll('.card.lightning-effect');
    
    cards.forEach(card => {
        // Tìm hoặc tạo container cho các đường mạng nhện
        let webContainer = card.querySelector('.web-container');
        if (!webContainer) {
            webContainer = document.createElement('div');
            webContainer.className = 'web-container';
            card.prepend(webContainer);
        }
        
        // Xóa các đường cũ
        webContainer.innerHTML = '';
        
        // Lấy các hạt
        const particles = card.querySelectorAll('.floating-particle');
        if (particles.length < 2) return;
        
        // Tạo mảng lưu vị trí các hạt có opacity > 0
        const activeParticles = [];
        particles.forEach(particle => {
            if (parseFloat(window.getComputedStyle(particle).opacity) > 0.05) { // Giảm ngưỡng opacity để bắt nhiều hạt hơn
                // Lấy vị trí tương đối với card
                const rect = particle.getBoundingClientRect();
                const cardRect = card.getBoundingClientRect();
                
                // Kiểm tra xem hạt có nằm trong card không
                if (rect.left >= cardRect.left && rect.right <= cardRect.right &&
                    rect.top >= cardRect.top && rect.bottom <= cardRect.bottom) {
                    activeParticles.push({
                        x: rect.left - cardRect.left + rect.width/2,
                        y: rect.top - cardRect.top + rect.height/2,
                        element: particle,
                        id: particle.className.match(/p(\d+)/)[1] // Lấy số hạt (p1, p2, ...)
                    });
                }
            }
        });
        
        // Nếu có ít nhất 2 hạt đang hiển thị, tạo các đường kết nối
        if (activeParticles.length >= 2) {
            // Giới hạn số lượng đường kết nối: mỗi hạt kết nối với tối đa 8 hạt khác
            const connections = new Map(); // Lưu trữ các kết nối đã tạo
            
            // Tạo các đường giữa các hạt
            for (let i = 0; i < activeParticles.length; i++) {
                // Mỗi hạt chỉ kết nối tối đa với 8 hạt khác
                if (!connections.has(i)) {
                    connections.set(i, []);
                }
                
                if (connections.get(i).length >= 8) {
                    continue; // Hạt này đã có đủ 8 kết nối
                }
                
                // Tìm 8 hạt gần nhất để kết nối
                const nearestParticles = findNearestParticles(activeParticles, i, connections);
                
                for (const j of nearestParticles) {
                    if (i === j) continue;
                    
                    // Tránh kết nối ngược lại
                    if (connections.has(j) && connections.get(j).includes(i)) {
                        continue;
                    }
                    
                    // Thêm kết nối vào danh sách
                    connections.get(i).push(j);
                    if (!connections.has(j)) {
                        connections.set(j, []);
                    }
                    connections.get(j).push(i);
                    
                    const start = activeParticles[i];
                    const end = activeParticles[j];
                    
                    createWebLine(start, end, webContainer, card);
                    
                    // Dừng nếu đã đủ 8 kết nối
                    if (connections.get(i).length >= 8) {
                        break;
                    }
                }
            }

            // Thêm kết nối ngẫu nhiên để tăng tính tự nhiên và số lượng đường
            if (activeParticles.length > 3) {
                // Tăng số lượng kết nối ngẫu nhiên
                for (let i = 0; i < Math.min(20, activeParticles.length * 4); i++) {
                    const randomIndex1 = Math.floor(Math.random() * activeParticles.length);
                    const randomIndex2 = Math.floor(Math.random() * activeParticles.length);
                    
                    if (randomIndex1 !== randomIndex2) {
                        const start = activeParticles[randomIndex1];
                        const end = activeParticles[randomIndex2];
                        createWebLine(start, end, webContainer, card);
                    }
                }
            }
            
            // Thêm các đường mạng nhện cố định để tạo mạng lưới hoàn chỉnh hơn
            const cardWidth = card.offsetWidth;
            const cardHeight = card.offsetHeight;
            
            // Tạo thêm 20 điểm cố định để kết nối (tăng từ 15 lên 20)
            const fixedPoints = [];
            for (let i = 0; i < 20; i++) {
                fixedPoints.push({
                    x: Math.random() * cardWidth,
                    y: Math.random() * cardHeight,
                    element: particles[0], // Dùng hạt đầu tiên làm tham chiếu
                    id: `fixed${i}`
                });
            }
            
            // Kết nối các điểm cố định với các hạt (tăng tỷ lệ kết nối)
            for (let i = 0; i < Math.min(activeParticles.length, 8); i++) {
                for (let j = 0; j < Math.min(fixedPoints.length, 8); j++) {
                    if (Math.random() > 0.2) { // Tăng cơ hội kết nối từ 30% lên 80%
                        createWebLine(activeParticles[i], fixedPoints[j], webContainer, card);
                    }
                }
            }
            
            // Kết nối giữa các điểm cố định với nhau để tạo thêm mạng nhện dày đặc
            for (let i = 0; i < fixedPoints.length; i++) {
                for (let j = i + 1; j < fixedPoints.length; j++) {
                    if (Math.random() > 0.6) { // Tăng cơ hội kết nối từ 30% lên 40%
                        createWebLine(fixedPoints[i], fixedPoints[j], webContainer, card);
                    }
                }
            }
        }
    });
}

// Hàm tìm các hạt gần nhất
function findNearestParticles(particles, currentIndex, connections) {
    const current = particles[currentIndex];
    
    // Tính khoảng cách đến các hạt khác
    const distances = [];
    for (let i = 0; i < particles.length; i++) {
        if (i === currentIndex) continue;
        
        // Không kết nối với hạt đã có đủ kết nối
        if (connections.has(i) && connections.get(i).length >= 8) { // Tăng từ 5 lên 8
            continue;
        }
        
        const other = particles[i];
        const distance = Math.sqrt(
            Math.pow(other.x - current.x, 2) + 
            Math.pow(other.y - current.y, 2)
        );
        
        distances.push({ index: i, distance });
    }
    
    // Sắp xếp theo khoảng cách tăng dần
    distances.sort((a, b) => a.distance - b.distance);
    
    // Trả về chỉ số của 8 hạt gần nhất (tăng từ 5 lên 8)
    return distances.slice(0, 8).map(d => d.index);
}

// Hàm tạo đường mạng nhện
function createWebLine(start, end, container, card) {
    // Tính toán độ dài và góc của đường
    const length = Math.sqrt(Math.pow(end.x - start.x, 2) + Math.pow(end.y - start.y, 2));
    const angle = Math.atan2(end.y - start.y, end.x - start.x) * 180 / Math.PI;
    
    // Đặt độ mờ tối đa
    const lineOpacity = 1.0;
    
    // Tạo đường
    const line = document.createElement('div');
    line.className = 'web-line';
    line.dataset.startId = start.id;
    line.dataset.endId = end.id;
    line.style.width = `${length}px`;
    line.style.left = `${start.x}px`;
    line.style.top = `${start.y}px`;
    line.style.transform = `rotate(${angle}deg)`;
    line.style.opacity = lineOpacity;
    
    // Sử dụng border màu xanh đậm và dày hơn
    line.style.height = `0`;
    line.style.backgroundColor = 'transparent';
    line.style.borderTop = '2px solid #0033FF';
    
    // Loại bỏ filter và sử dụng box-shadow rõ nét
    line.style.filter = 'none';
    line.style.boxShadow = '0 0 0 1px #0033FF, 0 0 3px 0 #0033FF';
    
    // Đảm bảo hiển thị dưới ảnh
    line.style.zIndex = '5';
    
    // Tối ưu hiệu năng render
    line.style.willChange = 'transform, opacity, left, top, width';
    line.style.imageRendering = 'crisp-edges';
    line.style.webkitFontSmoothing = 'antialiased';
    line.style.mozOsxFontSmoothing = 'grayscale';
    
    // Thêm CSS inline để luôn đảm bảo rõ nét
    line.style.backfaceVisibility = 'hidden';

    // Thêm vào container
    container.appendChild(line);
    
    // Cập nhật vị trí đường khi hạt di chuyển
    updateWebLinePosition(line, start.element, end.element, card);
}

// Cập nhật vị trí đường mạng nhện khi các hạt di chuyển
function updateWebLinePositions() {
    const cards = document.querySelectorAll('.card.lightning-effect');
    
    cards.forEach(card => {
        const webContainer = card.querySelector('.web-container');
        if (!webContainer) return;
        
        const webLines = webContainer.querySelectorAll('.web-line');
        webLines.forEach(line => {
            const startId = line.dataset.startId;
            const endId = line.dataset.endId;
            
            if (!startId || !endId) return;
            
            const startElement = card.querySelector(`.p${startId}`);
            const endElement = card.querySelector(`.p${endId}`);
            
            if (startElement && endElement) {
                updateWebLinePosition(line, startElement, endElement, card);
            }
        });
    });
}

// Cập nhật vị trí và góc của đường mạng nhện
function updateWebLinePosition(line, startElement, endElement, card) {
    const startOpacity = parseFloat(window.getComputedStyle(startElement).opacity);
    const endOpacity = parseFloat(window.getComputedStyle(endElement).opacity);
    
    // Chỉ hiển thị đường khi cả hai hạt đều hiển thị
    if (startOpacity > 0.1 && endOpacity > 0.1) {
        const startRect = startElement.getBoundingClientRect();
        const endRect = endElement.getBoundingClientRect();
        const cardRect = card.getBoundingClientRect();
        
        const startX = startRect.left - cardRect.left + startRect.width / 2;
        const startY = startRect.top - cardRect.top + startRect.height / 2;
        const endX = endRect.left - cardRect.left + endRect.width / 2;
        const endY = endRect.top - cardRect.top + endRect.height / 2;
        
        // Tính toán độ dài và góc giữa hai hạt
        const length = Math.sqrt(Math.pow(endX - startX, 2) + Math.pow(endY - startY, 2));
        const angle = Math.atan2(endY - startY, endX - startX) * 180 / Math.PI;
        
        // Cập nhật mượt mà bằng transition
        if (!line.style.transition) {
            line.style.transition = 'left 0.3s ease-out, top 0.3s ease-out, transform 0.3s ease-out, width 0.3s ease-out';
        }
        
        // Áp dụng vào đường
        line.style.width = `${length}px`;
        line.style.left = `${startX}px`;
        line.style.top = `${startY}px`;
        line.style.transform = `rotate(${angle}deg)`;
        
        // Luôn đặt opacity tối đa
        line.style.opacity = '1';
        
        // Đảm bảo luôn rõ ràng, sắc nét với màu xanh đậm
        line.style.height = '0';
        line.style.backgroundColor = 'transparent';
        line.style.borderTop = '2px solid #0033FF';
        line.style.filter = 'none';
        line.style.boxShadow = '0 0 0 1px #0033FF, 0 0 3px 0 #0033FF';
        line.style.zIndex = '5';
        
        // Đảm bảo đường không vượt ra ngoài card
        if (startX < 0 || startY < 0 || startX > cardRect.width || startY > cardRect.height ||
            endX < 0 || endY < 0 || endX > cardRect.width || endY > cardRect.height) {
            line.style.opacity = '0';
        }
    } else {
        // Fade out mượt mà
        if (!line.style.transition) {
            line.style.transition = 'opacity 0.5s ease-out';
        }
        line.style.opacity = '0';
    }
}

// Lên lịch cập nhật các hiệu ứng
function scheduleLightningUpdates() {
    // Cập nhật hạt ngẫu nhiên theo lịch
    function scheduleNextParticleUpdate() {
        // Cập nhật nhiều hạt hơn mỗi lần (tăng từ 2-3 lên 3-5 hạt)
        const updateCount = 3 + Math.floor(Math.random() * 3); // 3, 4 hoặc 5 hạt
        const cards = document.querySelectorAll('.card.lightning-effect');
        
        if (cards.length > 0) {
            // Cập nhật nhiều card trong một lần
            for (let c = 0; c < Math.min(updateCount, cards.length); c++) {
                const randomCardIndex = Math.floor(Math.random() * cards.length);
                const card = cards[randomCardIndex];
                const particles = card.querySelectorAll('.floating-particle');
                
                if (particles.length > 0) {
                    // Chọn một hạt ngẫu nhiên để cập nhật
                    const randomIndex = Math.floor(Math.random() * particles.length);
                    const particle = particles[randomIndex];
                    const particleIndex = randomIndex + 1;
                    updateParticleProperties(particle, particleIndex, card);
                }
            }
        }
        
        // Thời gian giữa các lần cập nhật được giảm xuống
        const randomTime = 500 + Math.random() * 700; // 0.5-1.2s (thay vì 1-2s)
        setTimeout(scheduleNextParticleUpdate, randomTime);
    }
    
    // Lên lịch cập nhật mạng nhện
    function scheduleNextWebUpdate() {
        // Cập nhật mạng nhện thường xuyên hơn
        updateWebLinePositions();
        
        // Tăng tần suất cập nhật mạng nhện để đường di chuyển mượt hơn
        setTimeout(scheduleNextWebUpdate, 20); // Giảm từ 30ms xuống 20ms
    }
    
    // Tạo lại các đường mạng nhện theo định kỳ
    function scheduleWebLinesRecreation() {
        createWebLines();
        
        // Tạo lại mạng nhện thường xuyên hơn
        const randomTime = 1000 + Math.random() * 800; // 1-1.8s (thay vì 1.5-2.5s)
        setTimeout(scheduleWebLinesRecreation, randomTime);
    }
    
    // Bắt đầu lịch trình cập nhật
    scheduleNextParticleUpdate();
    scheduleNextWebUpdate();
    scheduleWebLinesRecreation();
    
    // Thêm một hàm bổ sung để đảm bảo hiệu ứng vẫn hoạt động khi scroll
    function onScrollOrResize() {
        // Cập nhật vị trí của các hạt và đường mạng nhện khi scroll hoặc resize
        applyContainmentCSS();
        updateWebLinePositions();
    }
    
    // Thêm listener cho sự kiện scroll và resize
    window.addEventListener('scroll', onScrollOrResize, { passive: true });
    window.addEventListener('resize', onScrollOrResize, { passive: true });
}

// Khởi tạo hiệu ứng khi trang tải xong
document.addEventListener('DOMContentLoaded', function() {
    initLightningEffects();
});

// Xuất cho ESM
export { initLightningEffects, addParticlesToCards };

// Hàm để đảm bảo hiệu ứng nằm trong card
function applyContainmentCSS() {
    const cards = document.querySelectorAll('.card.lightning-effect');
    
    cards.forEach(card => {
        // Đảm bảo card có overflow hidden và position relative 
        card.style.overflow = 'hidden !important';
        card.style.position = 'relative';
        
        // Đảm bảo web container cũng được giới hạn trong card và nằm DƯỚI ảnh
        const webContainer = card.querySelector('.web-container');
        if (webContainer) {
            webContainer.style.overflow = 'hidden';
            webContainer.style.position = 'absolute';
            webContainer.style.inset = '0';
            webContainer.style.zIndex = '5'; // Giảm z-index để hiển thị dưới ảnh
        }
        
        // Đảm bảo các phần tử chứa ảnh có position relative và có z-index cao hơn đom đóm, mạng nhện
        const imageContainers = card.querySelectorAll('.relative, .overflow-hidden, .card-image');
        imageContainers.forEach(container => {
            container.style.position = 'relative';
            container.style.overflow = 'hidden';
            container.style.zIndex = '15'; // Đặt z-index cao hơn đom đóm (5) nhưng thấp hơn sao băng (20)
        });
        
        // Đảm bảo ảnh có z-index cao hơn đom đóm
        const images = card.querySelectorAll('img');
        images.forEach(img => {
            img.style.position = 'relative';
            img.style.zIndex = '15';
        });
        
        // Đảm bảo các sao băng có z-index cao nhất
        const stars = card.querySelectorAll('.shooting-star');
        stars.forEach(star => {
            star.style.zIndex = '20';
            star.style.pointerEvents = 'none';
        });
        
        // Di chuyển các hạt đom đóm vào trong giới hạn của card và đảm bảo hiển thị dưới ảnh
        const particles = card.querySelectorAll('.floating-particle');
        const cardRect = card.getBoundingClientRect();
        const padding = 6; // Padding để tránh hạt quá sát mép
        
        particles.forEach(particle => {
            particle.style.position = 'absolute';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '5'; // Giảm z-index để hiển thị dưới ảnh
            
            // Giới hạn các hạt vào trong card
            const particleRect = particle.getBoundingClientRect();
            
            if (particleRect.right > cardRect.right - padding) {
                particle.style.right = `${padding}px`;
                particle.style.left = 'auto';
            } else if (particleRect.left < cardRect.left + padding) {
                particle.style.left = `${padding}px`;
                particle.style.right = 'auto';
            }
            
            if (particleRect.bottom > cardRect.bottom - padding) {
                particle.style.bottom = `${padding}px`;
                particle.style.top = 'auto';
            } else if (particleRect.top < cardRect.top + padding) {
                particle.style.top = `${padding}px`;
                particle.style.bottom = 'auto';
            }
        });
        
        // Thêm !important vào CSS để đảm bảo luôn áp dụng
        const style = document.createElement('style');
        style.textContent = `
            .card.lightning-effect {
                overflow: hidden !important;
                position: relative !important;
            }
            .card.lightning-effect .web-container {
                overflow: hidden !important;
                position: absolute !important;
                inset: 0 !important;
                z-index: 5 !important;
            }
            .card.lightning-effect .web-line {
                height: 0 !important;
                background-color: transparent !important;
                border-top: 2px solid #0033FF !important;
                filter: none !important;
                box-shadow: 0 0 0 1px #0033FF, 0 0 3px 0 #0033FF !important;
                z-index: 5 !important;
                will-change: transform, opacity, left, top, width !important;
                image-rendering: -webkit-optimize-contrast !important;
                image-rendering: crisp-edges !important;
                -webkit-font-smoothing: antialiased !important;
                -moz-osx-font-smoothing: grayscale !important;
            }
            .card.lightning-effect .floating-particle {
                position: absolute !important;
                z-index: 5 !important;
            }
            .card.lightning-effect img,
            .card.lightning-effect .relative,
            .card.lightning-effect .overflow-hidden,
            .card.lightning-effect .card-image,
            .card.lightning-effect .card-content {
                position: relative !important;
                z-index: 15 !important;
            }
            .card.lightning-effect .shooting-star {
                z-index: 20 !important;
            }
        `;
        document.head.appendChild(style);
    });
} 