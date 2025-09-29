import './bootstrap';
import { initLightningEffects } from './lightning-effects';

document.addEventListener('DOMContentLoaded', function() {
    // Chỉ cần gọi hàm khởi tạo từ module đã import
    initLightningEffects();
    
    // Kích hoạt hiệu ứng AOS (nếu có)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }
});
