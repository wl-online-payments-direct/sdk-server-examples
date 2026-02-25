import { Link } from 'react-router-dom';
import './home.scss';
import translations from '../../translations/translations.ts';

const LIST_OPTIONS = [
    { label: translations.create_hosted_checkout_session, route: '/create-hosted-checkout' },
    { label: translations.create_payment_link, route: '/create-payment-link' },
    { label: translations.create_payment_using_hosted_tokenization, route: '/create-hosted-tokenization' },
    { label: translations.create_card_payment, route: '/create-card-payment' },
    { label: translations.create_direct_debit_payment, route: '/create-direct-debit-payment' },
    { label: translations.additional_payment_actions, route: '/additional-payment-actions' },
];

const HomePage = () => {
    return (
        <ul className="wl-list-container">
            {LIST_OPTIONS.map((option) => (
                <li key={option.route}>
                    <Link to={option.route}>{option.label}</Link>
                </li>
            ))}
        </ul>
    );
};

export default HomePage;
