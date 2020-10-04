import React, { createContext, useContext, useEffect, useState } from 'react';
import { API_BASE } from '../../config';

export interface Language {
  id: string;
  name: string;
  rtl: boolean;
}

const LanguageContext = createContext<readonly Language[]>([]);

export const LanguageProvider: React.FC = ({ children }) => {
  const [languages, setLanguages] = useState([]);
  useEffect(() => {
    fetch(`${API_BASE}/languages`)
      .then((response) => response.json())
      .then(setLanguages);
  }, []);

  return (
    <LanguageContext.Provider value={languages}>
      {children}
    </LanguageContext.Provider>
  );
};

export const useLanguages = () => useContext(LanguageContext);
