<style>
    .cookie-consent-banner {
        position: fixed;
        bottom: 0;
        left: 0;
        z-index: 2147483645;
        box-sizing: border-box;
        width: 100%;
        background-color: #f1f2f6;
    }

    .cookie-consent-banner__inner {
        max-width: 960px;
        margin: 0 auto;
        padding: 32px 0;
    }

    .cookie-consent-banner__copy {
        margin-bottom: 16px;
    }

    .cookie-consent-banner__actions {}

    .cookie-consent-banner__header {
        margin-bottom: 8px;

        font-family: "CeraPRO-Bold", sans-serif, arial;
        font-weight: normal;
        font-size: 16px;
        line-height: 24px;
    }

    .cookie-consent-banner__description {
        font-family: "CeraPRO-Regular", sans-serif, arial;
        font-weight: normal;
        color: #838F93;
        font-size: 16px;
        line-height: 24px;
    }

    .cookie-consent-banner__cta {
        box-sizing: border-box;
        display: inline-block;
        min-width: 164px;
        padding: 11px 13px;

        border-radius: 2px;

        background-color: #2c8fe0;

        color: #FFF;
        text-decoration: none;
        text-align: center;
        font-family: "CeraPRO-Regular", sans-serif, arial;
        font-weight: normal;
        font-size: 16px;
        line-height: 20px;
    }

    .cookie-consent-banner__cta--secondary {
        padding: 9px 13px;

        border: 2px solid #3A4649;

        background-color: transparent;

        color: #2c8fe0;
    }

    .cookie-consent-banner__cta:hover {
        background-color: #208eba;
    }

    .cookie-consent-banner__cta--secondary:hover {
        border-color: #838F93;

        background-color: transparent;

        color: #2278c8;
    }

    .cookie-consent-banner__cta:last-child {
        margin-left: 16px;
    }
</style>
<div id="cookie-consent-banner-panel" class="hidden cookie-consent-banner">
    <div class="cookie-consent-banner__inner">
        <div class="cookie-consent-banner__copy">
            <div class="cookie-consent-banner__header">CE SITE UTILISE DES COOKIES</div>
            <div class="cookie-consent-banner__description">Nous utilisons des cookies pour personnaliser le contenu et
                les publicités, pour fournir des fonctionnalités de médias sociaux et pour analyser notre trafic. Nous
                partageons également des informations sur votre utilisation de notre site avec nos partenaires de médias
                sociaux, de publicité et d'analyse, qui peuvent les combiner avec d'autres informations que vous leur
                avez fournies ou qu'ils ont collectées lors de votre utilisation de leurs services. Vous consentez à nos
                cookies si vous continuez à utiliser notre site Web.</div>
        </div>

        <div class="cookie-consent-banner__actions">
            <button id="accept-cookie" class="cookie-consent-banner__cta">
                Accepter
            </button>
            <button id="decline-cookie"  class="cookie-consent-banner__cta cookie-consent-banner__cta--secondary">
                Refuser
            </button>
        </div>
    </div>
</div>
