import type { AppProps } from 'next/app';
import React from 'react';
import { SWRConfig } from 'swr';
import { LanguageProvider } from 'context/Languages';

const MyApp = ({ Component, pageProps }: AppProps) => (
  <SWRConfig
    value={{
      refreshInterval: 3000,
      fetcher: (resource, init) =>
        fetch(resource, init).then((res) => res.json()),
    }}
  >
    <LanguageProvider>
      <Component {...pageProps} />
    </LanguageProvider>
  </SWRConfig>
);

export default MyApp;
