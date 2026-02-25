import { createBrowserRouter, Navigate, RouterProvider } from 'react-router-dom';
import HomePage from './pages/Home/HomePage.tsx';
import HostedCheckoutPage from './pages/HostedCheckout/HostedCheckoutPage.tsx';
import Layout from './components/Layout/Layout.tsx';
import { ToastProvider } from './components/Toast/ToastContext/ToastContext.tsx';
import ToastContainer from './components/Toast/Toast.tsx';
import CardPaymentPage from './pages/CardPayment/CardPaymentPage.tsx';
import HostedTokenizationPage from './pages/HostedTokenization/HostedTokenizationPage.tsx';
import PaymentLinkPage from './pages/PaymentLink/PaymentLinkPage.tsx';
import CardDebitPaymentPage from './pages/CardDebitPayment/CardDebitPaymentPage.tsx';
import AdditionalPaymentPage from './pages/AdditionalPayment/AdditionalPaymentPage.tsx';
import PaymentDetailsPage from './pages/PaymentDetails/PaymentDetailsPage.tsx';

const router = createBrowserRouter([
    {
        path: '/',
        element: <Layout />,
        children: [
            { path: '/', element: <HomePage /> },
            { path: '/payment-details', element: <PaymentDetailsPage /> },
            { path: '/create-hosted-checkout', element: <HostedCheckoutPage /> },
            { path: '/create-hosted-tokenization', element: <HostedTokenizationPage /> },
            { path: '/create-payment-link', element: <PaymentLinkPage /> },
            { path: '/create-card-payment', element: <CardPaymentPage /> },
            { path: '/create-direct-debit-payment', element: <CardDebitPaymentPage /> },
            { path: '/additional-payment-actions', element: <AdditionalPaymentPage /> },
            { path: '*', element: <Navigate to="/" replace /> },
        ],
    },
]);

const App = () => {
    return (
        <ToastProvider>
            <RouterProvider router={router} />
            <ToastContainer />
        </ToastProvider>
    );
};

export default App;
