import { Button, Grid, MenuItem, Select } from '@material-ui/core';
import React, { useMemo, useState } from 'react';
import { useLanguages, Language } from '../../context/Languages';

interface Props {
  addedLanguages: readonly string[];
  onAddTranslation: (language: Language) => void;
}

const AddNewTranslation = ({ addedLanguages, onAddTranslation }: Props) => {
  const languages = useLanguages();
  const remainingLanguages = useMemo(
    () => languages.filter((language) => !addedLanguages.includes(language.id)),
    [addedLanguages],
  );
  const [selectedLanguage, setSelectedLanguage] = useState('');

  const addTranslation = () => {
    if (!selectedLanguage) {
      return;
    }
    const language = remainingLanguages.find(
      (lang) => lang.id === selectedLanguage,
    );
    onAddTranslation(language);
    setSelectedLanguage('');
  };

  return (
    <Grid container spacing={2} alignItems="center">
      <Grid item xs={6}>
        <Select
          name="language"
          placeholder="Choose language to add"
          variant="outlined"
          fullWidth
          value={selectedLanguage}
          onChange={(e) => {
            setSelectedLanguage(e.target.value as string);
          }}
        >
          <MenuItem value="">-</MenuItem>
          {remainingLanguages.map((language) => (
            <MenuItem key={language.id} value={language.id}>
              {language.name}
            </MenuItem>
          ))}
        </Select>
      </Grid>
      <Grid item xs={6}>
        <Button
          onClick={() => addTranslation()}
          variant="contained"
          color="primary"
          fullWidth
          disabled={!selectedLanguage}
        >
          Add
        </Button>
      </Grid>
    </Grid>
  );
};

export default AddNewTranslation;
