import { Link } from 'react-router-dom';
import './header.scss';
import translations from '../../../translations/translations.ts';

const Header = () => {
    return (
        <nav className="wl-header">
            <div className="wlp-container">
                <Link className="wlp-logo" to="/">
                    {translations.header}
                </Link>
            </div>
        </nav>
    );
};

export default Header;
