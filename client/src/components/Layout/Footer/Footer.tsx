import './footer.scss';
import translations from '../../../translations/translations.ts';

const Footer = () => {
    return (
        <footer className="wl-footer">
            <div className="wlp-container">
                <p>
                    &copy; {new Date().getFullYear()} - {translations.footer}
                </p>
            </div>
        </footer>
    );
};

export default Footer;
