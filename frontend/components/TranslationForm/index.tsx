import { Grid, makeStyles } from '@material-ui/core';
import React, { useMemo, useReducer } from 'react';
import { Language } from '../../context/Languages/index';
import AddNewTranslation from './AddNewTranslation';
import { Entry } from './consts';
import { create, edit, reducer, remove, update } from './state';
import TranslationEntry from './TranslationEntry';
import translationsClient from 'client/translations';

const useStyles = makeStyles({
  container: {
    padding: '50px 0',
  },
  label: {
    width: '200px',
  },
});

interface Props {
  entry: Entry;
}

const TranslationForm = ({ entry }: Props) => {
  const styles = useStyles();

  const [translations, send] = useReducer(
    reducer,
    entry.translations,
    (translations) =>
      Object.fromEntries(
        Object.values(translations).map((translation) => [
          translation.language,
          {
            translation,
            isNew: false,
            isEditing: false,
          },
        ]),
      ),
  );

  const addedLanguages = useMemo(() => Object.keys(translations), [
    translations,
  ]);

  const handleAddTranslation = (language: Language) => {
    send({ type: 'add', language });
  };

  const handleCancel = (language: string) => {
    send({ type: 'cancel', language });
  };
  const handleEdit = (translation: string, language: string) => {
    translationsClient.edit(entry.id, language, translation);
    send(update(translation, language));
  };

  const handleCreate = (translation, language) => {
    translationsClient.create(entry.id, language, translation);
    send(create(translation, language));
  };

  const handleStartEditing = (language: string) => {
    send(edit(language));
  };

  const handleDelete = (language: string) => {
    translationsClient.delete(entry.id, language);
    send(remove(language));
  };

  return (
    <Grid container spacing={2} classes={{ container: styles.container }}>
      <Grid item xs={12} container>
        <Grid item classes={{ item: styles.label }}>
          {entry.name}
        </Grid>
        <Grid item xs>
          <AddNewTranslation
            addedLanguages={addedLanguages}
            onAddTranslation={handleAddTranslation}
          />
        </Grid>
      </Grid>
      {Object.values(translations).map((trans) => (
        <TranslationEntry
          {...trans}
          key={trans.translation.language}
          onCancel={() => handleCancel(trans.translation.language)}
          onEdit={handleEdit}
          onCreate={handleCreate}
          onStartEditing={() => handleStartEditing(trans.translation.language)}
          onDelete={() => handleDelete(trans.translation.language)}
        />
      ))}
    </Grid>
  );
};

export default TranslationForm;
