import { Container } from '@material-ui/core';
import TranslationForm from 'components/TranslationForm';
import { API_BASE } from 'config';
import { useRouter } from 'next/router';
import React from 'react';
import useSWR from 'swr';

const Translation = () => {
  const router = useRouter();
  const { key } = router.query;

  const { data } = useSWR(key ? `${API_BASE}/key/${key}` : null, {
    refreshInterval: 0,
  });

  if (!data) {
    return <span>Loading</span>;
  }

  return (
    <Container maxWidth="sm">
      <TranslationForm entry={data} />
    </Container>
  );
};

export default Translation;
