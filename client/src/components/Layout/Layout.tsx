import { Outlet, useLocation } from 'react-router-dom';
import Header from './Header/Header.tsx';
import Footer from './Footer/Footer.tsx';
import './layout.scss';

const Layout = () => {
    const location = useLocation();

    return (
        <div className="wl-layout">
            <Header />
            <div className={`wlp-layout-container ${location.pathname === '/' ? 'wlv--white' : 'wlv--gray'}`}>
                <div className="wlp-container-content">
                    <Outlet />
                </div>
            </div>
            <Footer />
        </div>
    );
};

export default Layout;
